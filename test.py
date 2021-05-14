from os import environ
from requests_html import HTMLSession

urls = [
    'https://donyad.com/',
    'https://class-plus.ir/',
    'https://lyndaapp.ir/',
    'https://git.ir/lynda/',
    'https://git.ir/',
    'https://www.yasdl.com/tag/%D9%81%DB%8C%D9%84%D9%85-%D8%A2%D9%85%D9%88%D8%B2%D8%B4%DB%8C-lynda',
    'https://www.yasdl.com/tag/%D9%81%DB%8C%D9%84%D9%85-%D9%87%D8%A7%DB%8C-%D8%B1%D8%A7%DB%8C%DA%AF%D8%A7%D9%86-lynda',
    'https://farsilynda.com/',
    'https://ilynda.ir/',
    'https://p30download.com/',
    'http://bitdownload.ir/',
    'https://moobmoo.com/',
    'https://modireweb.com/',
    'https://www.3dmaxfarsi.ir/',
    'http://persiangfx.com/',
    'https://fileniko.com/',
    'https://www.aparat.com/',
    'https://www.lynda.com/',
]
lines = ''
for url in urls:
    if len(url.strip()) == 0:
        continue
    print(url)
    ses = HTMLSession()
    response = ses.get(url)
    content = response.html.find('meta[name="keywords"]', first=True)
    if content:
        print('found')
        # print(content.attrs['content'])
        lines += content.attrs['content']

lines = re.split(',|،', lines)
lines = [s.strip() for s in lines]
print(len(lines))
lines = list(set(lines))
print(len(lines))
lines = ' , '.join(lines)
# print(lines)
with open('test.txt', 'w+', encoding='utf-8') as f:
    f.write(lines)
