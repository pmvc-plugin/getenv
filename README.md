[![Latest Stable Version](https://poser.pugx.org/pmvc-plugin/getenv/v/stable)](https://packagist.org/packages/pmvc-plugin/getenv) 
[![Latest Unstable Version](https://poser.pugx.org/pmvc-plugin/getenv/v/unstable)](https://packagist.org/packages/pmvc-plugin/getenv) 
[![CircleCI](https://circleci.com/gh/pmvc-plugin/getenv/tree/main.svg?style=svg)](https://circleci.com/gh/pmvc-plugin/getenv/tree/main)
[![License](https://poser.pugx.org/pmvc-plugin/getenv/license)](https://packagist.org/packages/pmvc-plugin/getenv)
[![Total Downloads](https://poser.pugx.org/pmvc-plugin/getenv/downloads)](https://packagist.org/packages/pmvc-plugin/getenv) 

PMVC Getenv Plugin 
===============
   * getenv wrapper for pmvc-plugin/get
   * https://github.com/pmvc-plugin/get

# How to use
   * check the unit test funciotn testGet
   * https://github.com/pmvc-plugin/getenv/blob/main/test.php#L17



## Install with Composer
### 1. Download composer
   * mkdir test_folder
   * curl -sS https://getcomposer.org/installer | php

### 2. Install Use composer.json or use command-line directly
#### 2.1 Install Use composer.json
   * vim composer.json
```
{
    "require": {
        "pmvc-plugin/getenv": "dev-main"
    }
}
```
   * php composer.phar install

#### 2.2 Or use composer command-line
   * php composer.phar require pmvc-plugin/getenv

