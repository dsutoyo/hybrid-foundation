# Hybrid Foundation

A starter theme based on <a href="http://http://themehybrid.com/hybrid-core/">Hybrid Core</a> and Foundation 6.1.2.

## Getting Started
### Prerequisites

You only need to do this once on your development machine.

* Install <a href="https://nodejs.org/download/" title="Permalink to the Node.js website for download instructions">Node.js</a>
* Install <a href="http://sass-lang.com/install" title="Permalink to the Sass website for install instructions">Sass</a>
* Install Bower - from Terminal or Command Prompt run `npm install --g bower`
* Install Gulp.js - from Terminal or Command Prompt run `npm install --global gulp`

### Project Setup

#### 1. Clone the repository

```
$ cd my-wordpress-folder/wp-content/themes/
$ git clone git@github.com:dsutoyo/hybrid-foundation.git
$ mv hybrid-foundation your-theme-name
$ cd your-theme-name

$ npm install
$ bower install
```

#### 2. Copy dependencies (optional)

We don't need everything in `bower_components`, so we're going to copy some of them over to our `assets/vendor` directory. The necessary files are already in `assets/vendor` so this step is optional for setup, but required if you are updating dependencies.

```
$ gulp deps
```

#### 3. Edit gulpfile.js

Change `proxy: 'wordpress.dev/'` to `proxy: 'my-site.dev/'` in gulpfile.js, where `'my-site'` is your local domain

#### 4. Run Gulp

The default gulp task compiles Sass and automatically refreshes your browser every time you update your files.

```
$ gulp
```
