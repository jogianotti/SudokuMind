SudokuMind
==========


### Ejecutar el programa con Docker

```shell
docker run --rm --interactive --tty \
--volume "$PWD":/app \
--workdir /app \
php:7.4-cli php index.php
```
