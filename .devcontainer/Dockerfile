# [Choice] Ubuntu version
FROM mcr.microsoft.com/devcontainers/base:ubuntu-24.04

# Install PHP 8.3, Composer, SQLite, and system dependencies
RUN apt-get update \
    && apt-get install -y \
        php8.3 php8.3-cli php8.3-mbstring php8.3-xml php8.3-curl php8.3-sqlite3 php8.3-zip php8.3-gd php8.3-bcmath \
        sqlite3 \
        unzip \
        curl \
        git \
        libpng-dev \
        libzip-dev \
        libonig-dev \
        libxml2-dev \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer --version \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Set up Node.js (handled by devcontainer features, but keep for reference)
# RUN curl -fsSL https://deb.nodesource.com/setup_22.x | bash - \
#     && apt-get install -y nodejs

# Set recommended locale
ENV LANG C.UTF-8

# Set working directory
WORKDIR /workspace

# [Optional] Add a non-root user (vscode)
# ARG USERNAME=vscode
# ARG USER_UID=1000
# ARG USER_GID=$USER_UID

# RUN groupadd --gid $USER_GID $USERNAME \
#    && useradd -s /bin/bash --uid $USER_UID --gid $USER_GID -m $USERNAME \
#    && chown -R $USERNAME:$USERNAME /workspace

# The devcontainer base image already provides the vscode user.

USER $USERNAME
