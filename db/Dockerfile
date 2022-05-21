FROM mysql:5.7
LABEL maintainer="imabeppu"

RUN useradd -m new_user && \
echo "new_user:password" | chpasswd

COPY ./my.cnf /etc/mysql/conf.d/my.cnf
