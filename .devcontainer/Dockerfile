FROM mcr.microsoft.com/devcontainers/php:7.4

ENV DEBIAN_FRONTEND=noninteractive
ENV TERM=xterm
ENV SHELL=/bin/zsh

# Remover repositorio de Yarn con clave GPG expirada
RUN rm -f /etc/apt/sources.list.d/yarn.list

RUN apt-get update && apt-get install -y \
    ca-certificates \
    git \
    locales \
    zsh \
    && rm -rf /var/lib/apt/lists/*

# Install Node.js 16.19
RUN bash -lc "source /usr/local/share/nvm/nvm.sh && \
    nvm install 16.19.0 && \
    nvm alias default 16.19.0 && \
    nvm use default"
