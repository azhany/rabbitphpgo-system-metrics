#!/bin/bash

# Function to check if a command exists
command_exists() {
    command -v "$1" >/dev/null 2>&1
}

# Install Go (Golang)
install_golang() {
    if ! command_exists go; then
        echo "Installing Go (Golang)..."
        wget -O go.tar.gz https://golang.org/dl/go1.17.linux-amd64.tar.gz
        sudo tar -C /usr/local -xzf go.tar.gz
        rm go.tar.gz
        export PATH=$PATH:/usr/local/go/bin
        echo 'export PATH=$PATH:/usr/local/go/bin' >>~/.bashrc
        source ~/.bashrc
        echo "Go (Golang) installed successfully."
    else
        echo "Go (Golang) is already installed."
    fi
}

# Install RabbitMQ
install_rabbitmq() {
    if ! command_exists rabbitmq-server; then
        echo "Installing RabbitMQ..."
        sudo apt-get update
        sudo apt-get install -y rabbitmq-server
        echo "RabbitMQ installed successfully."
    else
        echo "RabbitMQ is already installed."
    fi
}

# Main function
main() {
    install_golang
    install_rabbitmq
}

main
