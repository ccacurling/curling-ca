import babel from "rollup-plugin-babel";
import resolve from "rollup-plugin-node-resolve";
import commonjs from "rollup-plugin-commonjs";
import multiEntry from "rollup-plugin-multi-entry";
import { uglify } from "rollup-plugin-uglify";
import fs from 'fs';

const configs = [];

const jsFiles = fs.readdirSync('./js/');
const blockFiles = fs.readdirSync('js/blocks');

jsFiles.forEach(file => {
  var i = file.lastIndexOf(".js");
  var filename = i < 0 ? file : file.substr(0, i);

  if (i < 0) {
    return;
  }

  configs.push({
    input: [ './js/' + file ],
    output: {
      name: filename,
      file: `./js/dist/${filename}.min.js`,
      format: "cjs"
    },
    plugins: [
      multiEntry(),
      babel({
        exclude: "dist/**",
        presets: ["@babel/env", "@babel/preset-react"]
      }),
      resolve({
        browser: true,
        mainFields: ["jsnext:main"]
      }),
      commonjs(),
      uglify()
    ]
  });
});

blockFiles.forEach(file => {
  var i = file.lastIndexOf(".js");
  var filename = i < 0 ? file : file.substr(0, i);

  if (i < 0) {
    return;
  }

  for (var z = 0; z < 2; z++) {
    configs.push({
      input: [ `js/blocks/${filename}.js` ],
      output: {
        name: filename,
        file: z==0 ? `js/blocks/compiled/${filename}.js` : `js/dist/${filename}.min.js`,
        format: "cjs"
      },
      plugins: [
        multiEntry(),
        babel({
          exclude: "node_modules/**",
          presets: ["@babel/env", "@babel/preset-react"]
        }),
        resolve({
          browser: true,
          mainFields: ["jsnext:main"]
        }),
        commonjs(),
        z==0 ? null : uglify()
      ]
    });
  }
});

export default configs;
