FROM nginx:alpine

# Définir le répertoire de travail
WORKDIR /usr/share/nginx/html

# Copier tous les fichiers statiques d'un coup (html, js, css)
COPY ./ ./

# Copier la configuration nginx
COPY ./nginx/default.conf /etc/nginx/conf.d/default.conf
