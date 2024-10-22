#!/bin/sh

BASECN=$1
BASEDIR=cert

cat <<EOF> ${BASEDIR}/v3.ext
authorityKeyIdentifier=keyid,issuer
basicConstraints=CA:FALSE
keyUsage = digitalSignature, nonRepudiation, keyEncipherment, dataEncipherment
subjectAltName = @alt_names

[alt_names]
DNS.1 = ${BASECN}
EOF

openssl req -new \
  -newkey rsa:4098 -nodes -keyout ${BASEDIR}/privkey.pem \
  -out ${BASEDIR}/csr.pem \
  -subj "/C=ID/O=Local/OU=Local SSL/CN=${BASECN}"

openssl x509 -req -days 3650 -signkey ${BASEDIR}/privkey.pem \
  -sha256 -extfile ${BASEDIR}/v3.ext < ${BASEDIR}/csr.pem > ${BASEDIR}/fullchain.pem

openssl pkcs12 -export -out ${BASEDIR}/${BASECN}.pfx \
  -inkey ${BASEDIR}/privkey.pem -in ${BASEDIR}/fullchain.pem
