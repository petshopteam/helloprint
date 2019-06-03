FROM nginx:latest

ARG UID
ARG GUID
RUN usermod -u $UID www-data
RUN groupmod -g $GUID www-data

CMD ["nginx"]

EXPOSE 80