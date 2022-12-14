/*
 * jQuery slugIt plug-in 1.0
 *
 * Copyright (c) 2010 Diego Kuperman
 *
 * Inspired by perl module Text::Unidecode and Django urlfy.js
 *
 * Licensed under the BSD license:
 *      http://www.opensource.org/licenses/bsd-license.php
 */

jQuery.fn.slugIt = function(options) {
    var defaults = {
        events: 'keypress keyup',
        output: '#slug',
        separator: '-',
        map:    false,
        before: false,
        after: false
    };

    var opts  = jQuery.extend(defaults, options);

    var chars = latin_map();
        chars = jQuery.extend(chars, greek_map());
        chars = jQuery.extend(chars, turkish_map());
        chars = jQuery.extend(chars, russian_map());
        chars = jQuery.extend(chars, ukranian_map());
        chars = jQuery.extend(chars, czech_map());
        chars = jQuery.extend(chars, latvian_map());
        chars = jQuery.extend(chars, polish_map());
        chars = jQuery.extend(chars, symbols_map());
        chars = jQuery.extend(chars, currency_map());

    if ( opts.map ) {
        chars = jQuery.extend(chars, opts.map);
    }

    jQuery(this).bind(defaults.events, function() {
        var text = jQuery(this).val();

        if ( opts.before ) text = opts.before(text);
        text = jQuery.trim(text.toString());

        var slug = new String();
        for (var i = 0; i < text.length; i++) {
            if ( chars[text.charAt(i)] ) { slug += chars[text.charAt(i)] }
            else                         { slug += text.charAt(i) }
        }

        // Ensure separator is composable into regexes
        var sep_esc  = opts.separator.replace(/([.*+?^=!:${}()|\[\]\/\\])/g, "\\$1");
        var re_trail = new RegExp('^'+ sep_esc +'+|'+ sep_esc +'+$', 'g');
        var re_multi = new RegExp(sep_esc +'+', 'g');

        slug = slug.replace(/[^-\w\d\$\*\(\)\'\!\_]/g, opts.separator);  // swap spaces and unwanted chars
        slug = slug.replace(re_trail, '');                               // trim leading/trailing separators
        slug = slug.replace(re_multi, opts.separator);                   // eliminate repeated separatos
        slug = slug.toLowerCase();                                       // convert sting to lower case

        if ( opts.after ) slug = opts.after(slug);

        if ( typeof opts.output == "function" ) {
          opts.output(slug)
        } else {
          jQuery(opts.output).val(slug);         // input or textarea
          jQuery(opts.output).html(slug);        // other dom elements
        }

        return this;
    });

    function latin_map() {
        return {
            '??': 'A', '??': 'A', '??': 'A', '??': 'A', '??': 'A', '??': 'A', '??': 'AE', '??':
            'C', '??': 'E', '??': 'E', '??': 'E', '??': 'E', '??': 'I', '??': 'I', '??': 'I',
            '??': 'I', '??': 'D', '??': 'N', '??': 'O', '??': 'O', '??': 'O', '??': 'O', '??':
            'O', '??': 'O', '??': 'O', '??': 'U', '??': 'U', '??': 'U', '??': 'U', '??': 'U',
            '??': 'Y', '??': 'TH', '??': 'ss', '??':'a', '??':'a', '??': 'a', '??': 'a', '??':
            'a', '??': 'a', '??': 'ae', '??': 'c', '??': 'e', '??': 'e', '??': 'e', '??': 'e',
            '??': 'i', '??': 'i', '??': 'i', '??': 'i', '??': 'd', '??': 'n', '??': 'o', '??':
            'o', '??': 'o', '??': 'o', '??': 'o', '??': 'o', '??': 'o', '??': 'u', '??': 'u',
            '??': 'u', '??': 'u', '??': 'u', '??': 'y', '??': 'th', '??': 'y'
        };
    }

    function greek_map() {
        return {
            '??':'a', '??':'b', '??':'g', '??':'d', '??':'e', '??':'z', '??':'h', '??':'8',
            '??':'i', '??':'k', '??':'l', '??':'m', '??':'n', '??':'3', '??':'o', '??':'p',
            '??':'r', '??':'s', '??':'t', '??':'y', '??':'f', '??':'x', '??':'ps', '??':'w',
            '??':'a', '??':'e', '??':'i', '??':'o', '??':'y', '??':'h', '??':'w', '??':'s',
            '??':'i', '??':'y', '??':'y', '??':'i',
            '??':'A', '??':'B', '??':'G', '??':'D', '??':'E', '??':'Z', '??':'H', '??':'8',
            '??':'I', '??':'K', '??':'L', '??':'M', '??':'N', '??':'3', '??':'O', '??':'P',
            '??':'R', '??':'S', '??':'T', '??':'Y', '??':'F', '??':'X', '??':'PS', '??':'W',
            '??':'A', '??':'E', '??':'I', '??':'O', '??':'Y', '??':'H', '??':'W', '??':'I',
            '??':'Y'
        };
    }

    function turkish_map() {
        return {
            '??':'s', '??':'S', '??':'i', '??':'I', '??':'c', '??':'C', '??':'u', '??':'U',
            '??':'o', '??':'O', '??':'g', '??':'G'
        };
    }

    function russian_map() {
        return {
            '??':'a', '??':'b', '??':'v', '??':'g', '??':'d', '??':'e', '??':'yo', '??':'zh',
            '??':'z', '??':'i', '??':'j', '??':'k', '??':'l', '??':'m', '??':'n', '??':'o',
            '??':'p', '??':'r', '??':'s', '??':'t', '??':'u', '??':'f', '??':'h', '??':'c',
            '??':'ch', '??':'sh', '??':'sh', '??':'', '??':'y', '??':'', '??':'e', '??':'yu',
            '??':'ya',
            '??':'A', '??':'B', '??':'V', '??':'G', '??':'D', '??':'E', '??':'Yo', '??':'Zh',
            '??':'Z', '??':'I', '??':'J', '??':'K', '??':'L', '??':'M', '??':'N', '??':'O',
            '??':'P', '??':'R', '??':'S', '??':'T', '??':'U', '??':'F', '??':'H', '??':'C',
            '??':'Ch', '??':'Sh', '??':'Sh', '??':'', '??':'Y', '??':'', '??':'E', '??':'Yu',
            '??':'Ya'
        };
    }

    function ukranian_map() {
        return {
            '??':'Ye', '??':'I', '??':'Yi', '??':'G', '??':'ye', '??':'i', '??':'yi', '??':'g'
        };
    }

    function czech_map() {
        return {
            '??':'c', '??':'d', '??':'e', '??': 'n', '??':'r', '??':'s', '??':'t', '??':'u',
            '??':'z', '??':'C', '??':'D', '??':'E', '??': 'N', '??':'R', '??':'S', '??':'T',
            '??':'U', '??':'Z'
        };
    }

    function polish_map() {
        return {
            '??':'a', '??':'c', '??':'e', '??':'l', '??':'n', '??':'o', '??':'s', '??':'z',
            '??':'z', '??':'A', '??':'C', '??':'e', '??':'L', '??':'N', '??':'o', '??':'S',
            '??':'Z', '??':'Z'
        };
    }

    function latvian_map() {
        return {
            '??':'a', '??':'c', '??':'e', '??':'g', '??':'i', '??':'k', '??':'l', '??':'n',
            '??':'s', '??':'u', '??':'z', '??':'A', '??':'C', '??':'E', '??':'G', '??':'i',
            '??':'k', '??':'L', '??':'N', '??':'S', '??':'u', '??':'Z'
        };
    }

    function currency_map() {
        return {
            '???': 'euro', '$': 'dollar', '???': 'cruzeiro', '???': 'french franc', '??': 'pound',
            '???': 'lira', '???': 'mill', '???': 'naira', '???': 'peseta', '???': 'rupee',
            '???': 'won', '???': 'new shequel', '???': 'dong', '???': 'kip', '???': 'tugrik',
            '???': 'drachma', '???': 'penny', '???': 'peso', '???': 'guarani', '???': 'austral',
            '???': 'hryvnia', '???': 'cedi', '??': 'cent', '??': 'yen', '???': 'yuan',
            '???': 'yen', '???': 'rial', '???': 'ecu', '??': 'currency', '???': 'baht'
        };
    }

    function symbols_map() {
        return {
            '??':'(c)', '??': 'oe', '??': 'OE', '???': 'sum', '??': '(r)', '???': '+',
            '???': '"', '???': '"', '???': "'", '???': "'", '???': 'd', '??': 'f', '???': 'tm',
            '???': 'sm', '???': '...', '??': 'o', '??': 'o', '??': 'a', '???': '*',
            '???': 'delta', '???': 'infinity', '???': 'love', '&': 'and'
        };
    }

  return this;
};
