
  


  <style type="text/css">
    .ccard .card_icon,
    .ccard .status_icon {
      /* For a more robust cross-browser implementation, see http://bit.ly/aqZnl3 */
      display: inline-block;
      vertical-align: bottom;
      height: 23px;
      width: 27px;
    }
    .cardControl{
      width: 100%;
      font-size: 17px;
      padding: 3px 10px;
      border: 1px solid #d8d8d8;
      border-radius: 3px;
    }
    /* --- Card Icon --- */
    .ccard .card_icon {
      background: transparent url('assets/cardValidation/img/credit_card_sprites.png') no-repeat 30px 0;
      position: absolute;
      right: 34px;
    }
    .paymentDetailsCon .cardControl::placeholder{
    font-size: 12px!important;
  }
    
    /* Need to support IE6? These four rules won't work, so rewrite 'em. */
    .ccard .card_icon.visa       { background-position:   0   0 !important; }
    .ccard .card_icon.mastercard { background-position: -30px 0 !important; }
    .ccard .card_icon.amex       { background-position: -60px 0 !important; }
    .ccard .card_icon.discover   { background-position: -90px 0 !important; }

    /* --- Card Status --- */
    .ccard .status_icon {
      background: transparent url('assets/cardValidation/img/status_sprites.png') no-repeat 33px 0;
    }
    .ccard .invalid              { color: #AD3333; background: #f8e7e7; }
    .ccard .valid                { color: #33AD33; background: #e7f8e7; }
    .ccard .invalid .status_icon { background-position: 3px 0 !important; }
    .ccard .valid .status_icon   { background-position: -27px 0 !important; }
    .text-small{
      font-size: 11px;
    }


form #card_number {
  background-image: url(<?php echo base_url()?>/assets/images/card-number-images.png), url(<?php echo base_url()?>/assets/images/card-number-images.png);
  background-position: 2px -121px, 260px -61px;
  background-size: 120px 360px, 120px 361px;
  background-repeat: no-repeat;
  padding-left: 54px;
  padding-top: 0.375rem;
  padding-bottom: 0.375rem;
  width: 100%;

}
form #card_number.visa {
  background-position: 2px -163px, 260px -61px;
}
form #card_number.visa_electron {
  background-position: 2px -205px, 260px -61px;
}
form #card_number.mastercard {
  background-position: 2px -247px, 260px -61px;
}
form #card_number.maestro {
  background-position: 2px -289px, 260px -61px;
}
form #card_number.discover {
  background-position: 2px -331px, 260px -61px;
}
form #card_number.valid.visa {
  background-position: 2px -163px, 260px -87px;
}
form #card_number.valid.visa_electron {
  background-position: 2px -205px, 260px -87px;
}
form #card_number.valid.mastercard {
  background-position: 2px -247px, 260px -87px;
}
form #card_number.valid.maestro {
  background-position: 2px -289px, 260px -87px;
}
form #card_number.valid.discover {
  background-position: 2px -331px, 260px -87px;
}

.cards {
  border-radius: 2px;
  margin: 10px auto 0;
  padding: 13px 20px;
  width: 290px;
  color: #777;
  display: block;
  font-size: 14px;
  font-weight: 400;
  font-family: sans-serif;
}
.cards p {
  line-height: 1.5;
}
.cards a {
  color: #2e85e2;
  text-decoration: underline;
}

.help {
  font-size: 10px;
  color: #777;
  font-family: sans-serif;
  text-align: center;
}
.help a {
  color: #fff;
}

.card-types {
  border-radius: 2px;
  margin: 0 auto 0;
  padding: 13px 20px;
  width: 500px;
  color: #777;
}

  </style>


  <div class="form-group">
     <div class="row">
        <div class="col-sm-12">
          <input class="form-control  cardControl" name="card_number" id="card_number"  type="text" value="" placeholder="Credit Card Number" maxlength="16" autocomplete="off" required="required"  onkeypress="return isNumberKey(event)" >
        </div>
      </div>
  </div>
     
    <div class="form-group">
      <div class="row">
        <div class="col-sm-3">
          <input type="text"  class="form-control numbervalidation" name="card_exp_month" id="card_exp_month" placeholder="MM" maxlength="2"   required="required" /><!-- 1010 -->
        </div>
        <div class="col-sm-3 com_wrap">
          <input type="text"  class="form-control numbervalidation" name="card_exp_year" id="card_exp_year" placeholder="YYYY" maxlength="4"   required="required" /><!-- YYYYY -->
        </div>
        <div class="col-sm-6 com_wrap">
          <input type="password"  class="form-control numbervalidation"  name="card_cvc" id="card_cvc" placeholder="CVV" maxlength="4" autocomplete="off"    required="required" />
        </div>
      </div>
      
    </div> 
<script type="text/javascript">
 
 (function() {
 var self = (typeof window !== 'undefined') ? window : {};

 

var Prism = (function(){

// Private helper vars
var lang = /\blang(?:uage)?-(?!\*)(\w+)\b/i;

var _ = self.Prism = {
  util: {
    encode: function (tokens) {
      if (tokens instanceof Token) {
        return new Token(tokens.type, _.util.encode(tokens.content));
      } else if (_.util.type(tokens) === 'Array') {
        return tokens.map(_.util.encode);
      } else {
        return tokens.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/\u00a0/g, ' ');
      }
    },

    type: function (o) {
      return Object.prototype.toString.call(o).match(/\[object (\w+)\]/)[1];
    },

    // Deep clone a language definition (e.g. to extend it)
    clone: function (o) {
      var type = _.util.type(o);

      switch (type) {
        case 'Object':
          var clone = {};

          for (var key in o) {
            if (o.hasOwnProperty(key)) {
              clone[key] = _.util.clone(o[key]);
            }
          }

          return clone;

        case 'Array':
          return o.slice();
      }

      return o;
    }
  },

  languages: {
    extend: function (id, redef) {
      var lang = _.util.clone(_.languages[id]);

      for (var key in redef) {
        lang[key] = redef[key];
      }

      return lang;
    },

    // Insert a token before another token in a language literal
    insertBefore: function (inside, before, insert, root) {
      root = root || _.languages;
      var grammar = root[inside];
      var ret = {};

      for (var token in grammar) {

        if (grammar.hasOwnProperty(token)) {

          if (token == before) {

            for (var newToken in insert) {

              if (insert.hasOwnProperty(newToken)) {
                ret[newToken] = insert[newToken];
              }
            }
          }

          ret[token] = grammar[token];
        }
      }

      return root[inside] = ret;
    },

    // Traverse a language definition with Depth First Search
    DFS: function(o, callback) {
      for (var i in o) {
        callback.call(o, i, o[i]);

        if (_.util.type(o) === 'Object') {
          _.languages.DFS(o[i], callback);
        }
      }
    }
  },

  highlightAll: function(async, callback) {
    var elements = document.querySelectorAll('code[class*="language-"], [class*="language-"] code, code[class*="lang-"], [class*="lang-"] code');

    for (var i=0, element; element = elements[i++];) {
      _.highlightElement(element, async === true, callback);
    }
  },

  highlightElement: function(element, async, callback) {
    // Find language
    var language, grammar, parent = element;

    while (parent && !lang.test(parent.className)) {
      parent = parent.parentNode;
    }

    if (parent) {
      language = (parent.className.match(lang) || [,''])[1];
      grammar = _.languages[language];
    }

    if (!grammar) {
      return;
    }

    // Set language on the element, if not present
    element.className = element.className.replace(lang, '').replace(/\s+/g, ' ') + ' language-' + language;

    // Set language on the parent, for styling
    parent = element.parentNode;

    if (/pre/i.test(parent.nodeName)) {
      parent.className = parent.className.replace(lang, '').replace(/\s+/g, ' ') + ' language-' + language;
    }

    var code = element.textContent;

    if(!code) {
      return;
    }

    var env = {
      element: element,
      language: language,
      grammar: grammar,
      code: code
    };

    _.hooks.run('before-highlight', env);

    if (async && self.Worker) {
      var worker = new Worker(_.filename);

      worker.onmessage = function(evt) {
        env.highlightedCode = Token.stringify(JSON.parse(evt.data), language);

        _.hooks.run('before-insert', env);

        env.element.innerHTML = env.highlightedCode;

        callback && callback.call(env.element);
        _.hooks.run('after-highlight', env);
      };

      worker.postMessage(JSON.stringify({
        language: env.language,
        code: env.code
      }));
    }
    else {
      env.highlightedCode = _.highlight(env.code, env.grammar, env.language)

      _.hooks.run('before-insert', env);

      env.element.innerHTML = env.highlightedCode;

      callback && callback.call(element);

      _.hooks.run('after-highlight', env);
    }
  },

  highlight: function (text, grammar, language) {
    var tokens = _.tokenize(text, grammar);
    return Token.stringify(_.util.encode(tokens), language);
  },

  tokenize: function(text, grammar, language) {
    var Token = _.Token;

    var strarr = [text];

    var rest = grammar.rest;

    if (rest) {
      for (var token in rest) {
        grammar[token] = rest[token];
      }

      delete grammar.rest;
    }

    tokenloop: for (var token in grammar) {
      if(!grammar.hasOwnProperty(token) || !grammar[token]) {
        continue;
      }

      var pattern = grammar[token],
        inside = pattern.inside,
        lookbehind = !!pattern.lookbehind,
        lookbehindLength = 0;

      pattern = pattern.pattern || pattern;

      for (var i=0; i<strarr.length; i++) { // Don’t cache length as it changes during the loop

        var str = strarr[i];

        if (strarr.length > text.length) {
          // Something went terribly wrong, ABORT, ABORT!
          break tokenloop;
        }

        if (str instanceof Token) {
          continue;
        }

        pattern.lastIndex = 0;

        var match = pattern.exec(str);

        if (match) {
          if(lookbehind) {
            lookbehindLength = match[1].length;
          }

          var from = match.index - 1 + lookbehindLength,
              match = match[0].slice(lookbehindLength),
              len = match.length,
              to = from + len,
            before = str.slice(0, from + 1),
            after = str.slice(to + 1);

          var args = [i, 1];

          if (before) {
            args.push(before);
          }

          var wrapped = new Token(token, inside? _.tokenize(match, inside) : match);

          args.push(wrapped);

          if (after) {
            args.push(after);
          }

          Array.prototype.splice.apply(strarr, args);
        }
      }
    }

    return strarr;
  },

  hooks: {
    all: {},

    add: function (name, callback) {
      var hooks = _.hooks.all;

      hooks[name] = hooks[name] || [];

      hooks[name].push(callback);
    },

    run: function (name, env) {
      var callbacks = _.hooks.all[name];

      if (!callbacks || !callbacks.length) {
        return;
      }

      for (var i=0, callback; callback = callbacks[i++];) {
        callback(env);
      }
    }
  }
};

var Token = _.Token = function(type, content) {
  this.type = type;
  this.content = content;
};

Token.stringify = function(o, language, parent) {
  if (typeof o == 'string') {
    return o;
  }

  if (Object.prototype.toString.call(o) == '[object Array]') {
    return o.map(function(element) {
      return Token.stringify(element, language, o);
    }).join('');
  }

  var env = {
    type: o.type,
    content: Token.stringify(o.content, language, parent),
    tag: 'span',
    classes: ['token', o.type],
    attributes: {},
    language: language,
    parent: parent
  };

  if (env.type == 'comment') {
    env.attributes['spellcheck'] = 'true';
  }

  _.hooks.run('wrap', env);

  var attributes = '';

  for (var name in env.attributes) {
    attributes += name + '="' + (env.attributes[name] || '') + '"';
  }

  return '<' + env.tag + ' class="' + env.classes.join(' ') + '" ' + attributes + '>' + env.content + '</' + env.tag + '>';

};

if (!self.document) {
  if (!self.addEventListener) {
    // in Node.js
    return self.Prism;
  }
  // In worker
  self.addEventListener('message', function(evt) {
    var message = JSON.parse(evt.data),
        lang = message.language,
        code = message.code;

    self.postMessage(JSON.stringify(_.tokenize(code, _.languages[lang])));
    self.close();
  }, false);

  return self.Prism;
}

// Get current script and highlight
var script = document.getElementsByTagName('script');

script = script[script.length - 1];

if (script) {
  _.filename = script.src;

  if (document.addEventListener && !script.hasAttribute('data-manual')) {
    document.addEventListener('DOMContentLoaded', _.highlightAll);
  }
}

return self.Prism;

})();

if (typeof module !== 'undefined' && module.exports) {
  module.exports = Prism;
}
;
Prism.languages.clike = {
  'comment': {
    pattern: /(^|[^\\])(\/\*[\w\W]*?\*\/|(^|[^:])\/\/.*?(\r?\n|$))/g,
    lookbehind: true
  },
  'string': /("|')(\\?.)*?\1/g,
  'class-name': {
    pattern: /((?:(?:class|interface|extends|implements|trait|instanceof|new)\s+)|(?:catch\s+\())[a-z0-9_\.\\]+/ig,
    lookbehind: true,
    inside: {
      punctuation: /(\.|\\)/
    }
  },
  'keyword': /\b(if|else|while|do|for|return|in|instanceof|function|new|try|throw|catch|finally|null|break|continue)\b/g,
  'boolean': /\b(true|false)\b/g,
  'function': {
    pattern: /[a-z0-9_]+\(/ig,
    inside: {
      punctuation: /\(/
    }
  },
  'number': /\b-?(0x[\dA-Fa-f]+|\d*\.?\d+([Ee]-?\d+)?)\b/g,
  'operator': /[-+]{1,2}|!|<=?|>=?|={1,3}|&{1,2}|\|?\||\?|\*|\/|\~|\^|\%/g,
  'ignore': /&(lt|gt|amp);/gi,
  'punctuation': /[{}[\];(),.:]/g
};
;
Prism.languages.javascript = Prism.languages.extend('clike', {
  'keyword': /\b(break|case|catch|class|const|continue|debugger|default|delete|do|else|enum|export|extends|false|finally|for|function|get|if|implements|import|in|instanceof|interface|let|new|null|package|private|protected|public|return|set|static|super|switch|this|throw|true|try|typeof|var|void|while|with|yield)\b/g,
  'number': /\b-?(0x[\dA-Fa-f]+|\d*\.?\d+([Ee]-?\d+)?|NaN|-?Infinity)\b/g
});

Prism.languages.insertBefore('javascript', 'keyword', {
  'regex': {
    pattern: /(^|[^/])\/(?!\/)(\[.+?]|\\.|[^/\r\n])+\/[gim]{0,3}(?=\s*($|[\r\n,.;})]))/g,
    lookbehind: true
  }
});

if (Prism.languages.markup) {
  Prism.languages.insertBefore('markup', 'tag', {
    'script': {
      pattern: /<script[\w\W]*?>[\w\W]*?<\/script>/ig,
      inside: {
        'tag': {
          pattern: /<script[\w\W]*?>|<\/script>/ig,
          inside: Prism.languages.markup.tag.inside
        },
        rest: Prism.languages.javascript
      }
    }
  });
}
;
   
(function() {
  var $,
    __indexOf = [].indexOf || function(item) { for (var i = 0, l = this.length; i < l; i++) { if (i in this && this[i] === item) return i; } return -1; };

  $ = jQuery;

  $.fn.validateCreditCard = function(callback, options) {
    var bind, card, card_type, card_types, get_card_type, is_valid_length, is_valid_luhn, normalize, validate, validate_number, _i, _len, _ref;
    card_types = [
      {
        name: 'amex',
        pattern: /^3[47]/,
        valid_length: [15]
      }, {
        name: 'diners_club_carte_blanche',
        pattern: /^30[0-5]/,
        valid_length: [14]
      }, {
        name: 'diners_club_international',
        pattern: /^36/,
        valid_length: [14]
      }, {
        name: 'jcb',
        pattern: /^35(2[89]|[3-8][0-9])/,
        valid_length: [16]
      }, {
        name: 'laser',
        pattern: /^(6304|670[69]|6771)/,
        valid_length: [16, 17, 18, 19]
      }, {
        name: 'visa_electron',
        pattern: /^(4026|417500|4508|4844|491(3|7))/,
        valid_length: [16]
      }, {
        name: 'visa',
        pattern: /^4/,
        valid_length: [16]
      }, {
        name: 'mastercard',
        pattern: /^5[1-5]/,
        valid_length: [16]
      }, {
        name: 'maestro',
        pattern: /^(5018|5020|5038|6304|6759|676[1-3])/,
        valid_length: [12, 13, 14, 15, 16, 17, 18, 19]
      }, {
        name: 'discover',
        pattern: /^(6011|622(12[6-9]|1[3-9][0-9]|[2-8][0-9]{2}|9[0-1][0-9]|92[0-5]|64[4-9])|65)/,
        valid_length: [16]
      }
    ];
    bind = false;
    if (callback) {
      if (typeof callback === 'object') {
        options = callback;
        bind = false;
        callback = null;
      } else if (typeof callback === 'function') {
        bind = true;
      }
    }
    if (options == null) {
      options = {};
    }
    if (options.accept == null) {
      options.accept = (function() {
        var _i, _len, _results;
        _results = [];
        for (_i = 0, _len = card_types.length; _i < _len; _i++) {
          card = card_types[_i];
          _results.push(card.name);
        }
        return _results;
      })();
    }
    _ref = options.accept;
    for (_i = 0, _len = _ref.length; _i < _len; _i++) {
      card_type = _ref[_i];
      if (__indexOf.call((function() {
        var _j, _len1, _results;
        _results = [];
        for (_j = 0, _len1 = card_types.length; _j < _len1; _j++) {
          card = card_types[_j];
          _results.push(card.name);
        }
        return _results;
      })(), card_type) < 0) {
        throw "Credit card type '" + card_type + "' is not supported";
      }
    }
    get_card_type = function(number) {
      var _j, _len1, _ref1;
      _ref1 = (function() {
        var _k, _len1, _ref1, _results;
        _results = [];
        for (_k = 0, _len1 = card_types.length; _k < _len1; _k++) {
          card = card_types[_k];
          if (_ref1 = card.name, __indexOf.call(options.accept, _ref1) >= 0) {
            _results.push(card);
          }
        }
        return _results;
      })();
      for (_j = 0, _len1 = _ref1.length; _j < _len1; _j++) {
        card_type = _ref1[_j];
        if (number.match(card_type.pattern)) {
          return card_type;
        }
      }
      return null;
    };
    is_valid_luhn = function(number) {
      var digit, n, sum, _j, _len1, _ref1;
      sum = 0;
      _ref1 = number.split('').reverse();
      for (n = _j = 0, _len1 = _ref1.length; _j < _len1; n = ++_j) {
        digit = _ref1[n];
        digit = +digit;
        if (n % 2) {
          digit *= 2;
          if (digit < 10) {
            sum += digit;
          } else {
            sum += digit - 9;
          }
        } else {
          sum += digit;
        }
      }
      return sum % 10 === 0;
    };
    is_valid_length = function(number, card_type) {
      var _ref1;
      return _ref1 = number.length, __indexOf.call(card_type.valid_length, _ref1) >= 0;
    };
    validate_number = (function(_this) {
      return function(number) {
        var length_valid, luhn_valid;
        card_type = get_card_type(number);
        luhn_valid = false;
        length_valid = false;
        if (card_type != null) {
          luhn_valid = is_valid_luhn(number);
          length_valid = is_valid_length(number, card_type);
        }
        return {
          card_type: card_type,
          valid: luhn_valid && length_valid,
          luhn_valid: luhn_valid,
          length_valid: length_valid
        };
      };
    })(this);
    validate = (function(_this) {
      return function() {
        var number;
        number = normalize($(_this).val());
        return validate_number(number);
      };
    })(this);
    normalize = function(number) {
      return number.replace(/[ -]/g, '');
    };
    if (!bind) {
      return validate();
    }
    this.on('input.jccv', (function(_this) {
      return function() {
        $(_this).off('keyup.jccv');
        return callback.call(_this, validate());
      };
    })(this));
    this.on('keyup.jccv', (function(_this) {
      return function() {
        return callback.call(_this, validate());
      };
    })(this));
    callback.call(this, validate());
    return this;
  };

}).call(this);
  $(function() {
    $('.demo .numbers li').wrapInner('<a href="#"></a>').click(function(e) {
      e.preventDefault();
      $('.demo .numbers').slideUp(100);
      return $('#card_number').val($(this).text()).trigger('input');
    });
    $('body').click(function() {
      return $('.demo .numbers').slideUp(100);
    });
    $('.demo .numbers').click(function(e) {
      return e.stopPropagation();
    });
    $('#sample-numbers-trigger').click(function(e) {
      e.preventDefault();
      e.stopPropagation();
      return $('.demo .numbers').slideDown(100);
    });
    $('.demo .numbers').hide();
    $('.vertical.maestro').hide().css({
      opacity: 0
    });
    return $('#card_number').validateCreditCard(function(result) {
      //$(this).removeClass();
      if (result.card_type == null) {
        $('.vertical.maestro').slideUp({
          duration: 200
        }).animate({
          opacity: 0
        }, {
          queue: false,
          duration: 200
        });
        return;
      }
      $(this).addClass(result.card_type.name);
      if (result.card_type.name === 'maestro') {
        $('.vertical.maestro').slideDown({
          duration: 200
        }).animate({
          opacity: 1
        }, {
          queue: false
        });
      } else {
        $('.vertical.maestro').slideUp({
          duration: 200
        }).animate({
          opacity: 0
        }, {
          queue: false,
          duration: 200
        });
      }
      if (result.valid) {
        return $(this).addClass('valid');
      } else {
        return $(this).removeClass('valid');
      }
    }, {
      accept: ['visa', 'visa_electron', 'mastercard', 'maestro', 'discover']
    });
  });

}).call(this);

function isNumberKey(evt){
       var charCode = (evt.which) ? evt.which : event.keyCode
  if (charCode > 31 && (charCode < 48 || charCode > 57))
  return false;

  return true;
}
</script>
    
  

  