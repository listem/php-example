# Listem sample project

This contains the code for a sample implementation of the Listem package on a PHP app as a testament for being truly framework-agnostic. The app is build on top of the smallest of the PHP MVC frameworks, [MINI framework](https://github.com/panique/mini).

## Setting up

First, make sure you have Docker installed and running. Follow these steps to set up the project.

```
git clone <project.url> <project>
cd <project>
cp docker-compose.yml.example docker-compose.yml
```

Change values of the `yml` file if necessary (eg: port numbers)

```
docker-compose up -d
```