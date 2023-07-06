import requests
from bs4 import BeautifulSoup
import csv

# Send a request to the website and get the HTML page
url = "https://supertank.nl/prijsoverzicht"
page = requests.get(url)

# Use Beautiful Soup to parse the HTML page
soup = BeautifulSoup(page.text, "html.parser")

# Find the table element using the "table" selector
table = soup.select_one("table")

# Find the header row using the "tr.header" selector
header_row = table.select_one("tr.header")

# Find the data rows using the "tr:nth-of-type(n+2)" selector
data_rows = table.select("tr:nth-of-type(n+2)")

# Create a list to store the data
data = []

# Loop through the header row and get the text of each cell
header = []
for cell in header_row.find_all("th"):
    header.append(cell.text.strip())

# Add the header row to the data list
data.append(header)

# Loop through the data rows and get the text of each cell
for row in data_rows:
    row_data = []
    for cell in row.find_all("td"):
        row_data.append(cell.text.strip())
    data.append(row_data)

# Clean up the data
for i, row in enumerate(data):
    # Rename the second column
    if i == 0:
        row[1] = "Adres"
    else:
        # Convert the numbers to floats with 3 decimal places
        for j, cell in enumerate(row):
            if j > 0 and cell.isdecimal():  # Skip the first column (Adres) and non-numeric cells
                row[j] = float(cell.replace(",", "."))
            else:
                # Add a leading zero if the cell value starts with a decimal point
                if cell.startswith("0,"):
                    cell = "0." + cell
                # Remove the texts from the cells
                row[j] = cell.replace("(Euro95 E10)", "").replace("(Diesel B7)", "").replace("(SuperPlus98 E5)", "").replace("(LPG)", "").replace("(HVO100)", "").replace("(AdBlue)", "").replace("(Aardgas)", "").replace("(CNG)", "").replace("(Propaangas)", "").replace("(Aardgas )", "")


# Open a file for writing and create a CSV writer object
with open("/var/www/html/gas_prices.csv", "w", newline="") as file:
    writer = csv.writer(file)

    # Write each row of the data to the CSV file
    for row in data:
        writer.writerow(row)
