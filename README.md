# Test system.io

## Installation from script.
- First of all create copy of docker/.env.dist as docker/.env

If ports 888 and 54322 are busy on your computer change them to free ones. If that ports are not busy then leave them as they are.

- Then execute these two commands
```shell
make dc_rebuild_up
```
```shell
make app_install
```

- After successfull installation you can test on http://127.0.0.1:888/

I also crated data fixtures, so you can use already created users:

> NOTE: email: test@gmail.com password: qweqwe123
