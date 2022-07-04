# **Ambiente para testes de segurança em aplicações**

## Aplicações disponíveis:

- Site e servidor de email <a href="https://www.squirrelmail.org/">SquirrelMail</a>
- Site vulnerável <a href="https://dvwa.co.uk/">DVWA</a>

## Usuários das aplicações:
- admin:password
- vitima:vitima
- atacante:atacante

## Adicionar no arquivo hosts do sistema operacional:
```
{IP_WSL}   evebox.vuln.lab
{IP_WSL}   mail.vuln.lab
{IP_WSL}   dvwa.vuln.lab
{IP_WSL}   storage.vuln.lab
{IP_WSL}   site.vuln.lab
```

## Acessar pelos links:
- Evebox: http://evebox.vuln.lab
- Email: http://mail.vuln.lab
- DVWA: http://dvwa.vuln.lab
- Storage: http://storage.vuln.lab
- Blog: http://site.vuln.lab

## Comandos pré-definidos:
```
curl -H "Range: bytes=0-1000" "http://storage.vuln.lab/download.php?file=image-309kb.jpg" --output downloaded.jpg
```