# Use an official PHP runtime as a parent image
FROM php:7.4-apache

# Set the working directory to /var/www/html
WORKDIR /var/www/html

# Copy the current directory contents into the container at /var/www/html
COPY . /var/www/html

# Install any needed packages
RUN apt-get update -y && \
    apt-get install -y \
    libzip-dev \
    && docker-php-ext-install mysqli
    # Add any required packages here

# Make port 80 available to the world outside this container
EXPOSE 5000

# Define environment variable
ENV NAME World

# Run app.php when the container launches
CMD ["php", "-S", "0.0.0.0:5000"]
