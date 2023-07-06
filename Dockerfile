FROM php:8.2-rc-apache-bullseye
RUN apt-get update && apt-get install -y nano sudo neofetch wget curl npm cron python3-pip
RUN echo "neofetch" >> ~/.bashrc
RUN a2enmod rewrite
RUN npm install axios
RUN neofetch
COPY config.conf ~/.config/neofetch/config.conf
RUN useradd -rm -d /home/server -s /bin/bash -g root -G sudo -u 1000 server
RUN touch /home/server/.hushlogin
RUN echo 'server:YourPassword' | chpasswd
RUN echo 'root:YourPassword' | chpasswd
RUN echo "neofetch" >> /home/server/.bashrc
RUN mkdir /home/server/.config
RUN mkdir /home/server/.config/neofetch
RUN touch /home/server/.hushlogin
COPY config.conf /home/server/.config/neofetch/config.conf
RUN chown -R server /home/server
RUN pip install requests
RUN pip install bs4
COPY scraper.py /home/server
COPY html /var/www/html
RUN sudo chown -R server /var/www/html/gas_prices.csv
COPY cron /etc/cron.d/cron
RUN chmod 0644 /etc/cron.d/cron
RUN crontab /etc/cron.d/cron
RUN ln -s /dev/stdout /var/log/cron
RUN sed -i 's/^exec /service cron start\n\nexec /' /usr/local/bin/apache2-foreground
EXPOSE 80
