# Hybrid Foundation

A starter theme based on <a href="http://http://themehybrid.com/hybrid-core/">Hybrid Core</a> and Foundation 6.4.3.

## Getting Started
### Prerequisites

You only need to do this once on your development machine.

* Install <a href="https://nodejs.org/download/" title="Permalink to the Node.js website for download instructions">Node.js</a>
* Install <a href="http://sass-lang.com/install" title="Permalink to the Sass website for install instructions">Sass</a>
* Install Gulp.js - from Terminal or Command Prompt run `npm install --global gulp`

### Project Setup

#### 1. Clone the repository

```
$ cd my-wordpress-folder/wp-content/themes/
$ git clone git@github.com:dsutoyo/hybrid-foundation.git
$ mv hybrid-foundation your-theme-name
$ cd your-theme-name

$ npm install
```

#### 2. Edit gulpfile.js

Change `proxy: 'wordpress.dev/'` to `proxy: 'my-site.dev/'` in gulpfile.js, where `'my-site'` is your local domain

#### 3. Run Gulp

The default gulp task compiles Sass and automatically refreshes your browser every time you update your files.

```
$ gulp
```
