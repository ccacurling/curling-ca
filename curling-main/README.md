# Building

## Compiling Javascript
```
node_modules/.bin/gulp rollup
```
Watch task:
```
node_modules/.bin/gulp rollup:watch
```

# Testing

## Run Acceptance Tests
```
node_modules/.bin/selenium-standalone start
npm run codecept
```
  
## Run Unit Tests
Use Test Explorer or:  
```
vendor/bin/phpunit
```
  
## Run Jest (For javascript modules)
Use Test Explorer or:  
```
node_modules/.bin/jest.js
```
