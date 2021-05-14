function download(filename, text) {
    var element = document.createElement('a');
    element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(text));
    element.setAttribute('download', filename);
    element.style.display = 'none';

    document.body.appendChild(element);
    element.click();
    document.body.removeChild(element);
}

function get_tags(elements) {
    var res = "[\n";
    elements.forEach(function (item) {
        let text = item.text;
        text = text.substr(0, text.lastIndexOf('(')).trim();
        res +=
            "\t[" +
            "'title' => " + "\"" + text + "\"" +
            "],\n\t";
    });
    res += "]";
    return res;
}

let title = $("#hero-space > div > div.category-details.category-details-seo-branding.col-xs-12.col-sm-7.col-md-6 > h1")[0].textContent;
let titleEng = title;
let subjects = get_tags(document.querySelectorAll("#search-filters > ul > li:nth-child(1) > ul > li > a"));
let software = get_tags(document.querySelectorAll("#search-filters > ul > li:nth-child(2) > ul > li > a"));

let library = '[\n';
library += '\t"title" => "' + title + '",\n';
library += '\t"titleEng" => "' + titleEng + '",\n';
library += '\t"subjects" => ' + subjects + ',\n';
library += '\t"software" => ' + software + ',\n';
library += '\t"learn_paths" => [],\n';
library += '],\n';

download(title + '.txt', library);
