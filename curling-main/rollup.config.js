import babel from "rollup-plugin-babel";
import resolve from "rollup-plugin-node-resolve";
import commonjs from "rollup-plugin-commonjs";
import multiEntry from "rollup-plugin-multi-entry";
import { uglify } from "rollup-plugin-uglify";
import fs from 'fs';

const configs = [];

const files = fs.readdirSync('src/blocks');

files.forEach(file => {
  var i = file.lastIndexOf(".");
  var filename = i < 0 ? file : file.substr(0, i);

  for (var z = 0; z < 2; z++) {
    configs.push({
      input: [ `src/blocks/${file}/src/index.js` ],
      output: {
        name: filename,
        file: z==0 ? `src/blocks/${file}/js/index.js` : `dist/${file}.min.js`,
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
