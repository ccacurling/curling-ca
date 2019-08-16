# Building

## Compiling Javascript
```
node_modules/rollup/dist/bin/rollup -c
```
Watch task:
```
node_modules/rollup/dist/bin/rollup -c -w
```

# Testing

## Run Acceptance Tests
```
node_modules/selenium-standalone/bin/selenium-standalone start
npm run codecept
```
  
## Run Unit Tests
Use Test Explorer or:  
```
vendor/phpunit/phpunit/phpunit
```
  
## Run Jest (For javascript modules)
Use Test Explorer or:  
```
node_modules/jest/bin/jest.js
```
