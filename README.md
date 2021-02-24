# Listem - sample implementation

This is the code for a sample implementation of the Listem package on a PHP app as a testament to it's framework-agnosticity. This app is build on top of the smallest of the PHP MVC frameworks, the [MINI framework](https://github.com/panique/mini).

The live website can be found at [php-example.listem.co](https://php-example.listem.dev)

## Setting up

First, make sure you have [Docker and Docker Compose installed](https://docs.docker.com/compose/install) and running. Follow these steps to set up the project.

```
git clone <project.url> <project>
cd <project>
cp docker-compose.yml.example docker-compose.yml
```

Change values of the `yml` file if necessary (eg: port numbers), and run

```
make init
```