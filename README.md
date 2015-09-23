# Web_Development
Navigation International PHP Tutorial
##PHP Tutorial
@(领航教育)[IT|CSS|HTML|PHP|JavaScript|AngularJS|BootStrap]
##HTML

###介绍
>HTML is a markup language for describing web documents (web pages). 
	> HTML stands for Hyper Text Markup Language 
	> A markup language is a set of markup tags HTML documents are described by HTML tags
	> Each HTML tag describes different document content 
—— [W3CSchools](http://www.w3schools.com/html/html_intro.asp)

HTML(超文本标记语言)
- 扩展名是 .html
- 不是编程语言!!!
- 如果一行出错 浏览器会直接忽略
- debug会比较麻烦 需要逐行检查 (右键页面 选择检查元素)
- 多平台兼容性好 
- 首页通常命名为 index.html 

###编辑器
| Window      |    Mac |
| :---------- | :--------| 
| [Notepad](https://notepad-plus-plus.org/)  | [Coda2](https://panic.com/coda/) | 
| [Sublime](http://www.sublimetext.com/)     |  [Sublime](http://www.sublimetext.com/) | 

###格式
```
<!DOCTYPE html>
<html>
<body>

<h1>My First Heading</h1>
<p>My first paragraph.</p>

</body>
</html>
```

```
<tagname>content</tagname>
```
- 一开一闭: 所有的tagname都必须要有开有闭
- 所有的HTML页面都必须包括
	- `<!doctype html></html>` 声明HTML的版本
	- `<head></head>`网页的头文件 之间所有的内容不会显示在网页的页面上 包含关键字, 标题, 脚本...
		- `<title></title>` 网页的Title 会显示在浏览器的标签页上
	- `<body></body>` 网页的正文内容

###属性
- HTML的元素可以有属性
- 属性由名字和值组成: `name="value"`

####lang语言属性
页面的语言可以用`<html lang="en-US">`来修改 用来便于搜索引擎的抓取

```
<!DOCTYPE html>
<html lang="en-US">
<body>

	<h1>My First Heading</h1>
	<p>My first paragraph.</p>

</body>
</html>
```

####title标题属性
段落的标题可以用`title=" "`属性来直接生成
```
<p title="this is title">
	this is paragraph.
</p>
```
相比较与用`<h1></h1>`等方法, title更加方便, 但是缺点是没办法改变样式

####href链接属性
`href`链接属性通常位于`<a></a>`里面, 用来添加网页的链接

```
<a href="http://www.google.com">Google</a>
```

####alt属性
alt属性通常位于`<img></img>`里面, 用来代替图片加载不出的情况, 同时方便搜索引擎抓取图片

```
<img src="google.jpg" alt="google.com" width="100" height="100">
```


###元素
####Heading

```
<h1>This is a huge header.</h1>
<h2>This one's a little smaller.</h2>
<h3>And smaller still...</h3>
<h4>And so on</h4>
<h5>And on</h5>
<h6>Do you really want to go smaller than this?</h6>
```
<h1>This is a huge header.</h1>
<h2>This one's a little smaller.</h2>
<h3>And smaller still...</h3>
<h4>And so on</h4>
<h5>And on</h5>
<h6>Do you really want to go smaller than this?</h6>


####hr 水平线

```
<p>This is a paragraph.</p>
<hr>
<p>This is a paragraph.</p>
<hr>
<p>This is a paragraph.</p>
```
<p>This is a paragraph.</p>
<hr>
<p>This is a paragraph.</p>
<hr>
<p>This is a paragraph.</p>

####meta
- 用于SEO搜索引擎的优化
	- 搜索的标题 
`<meta name="title" content="领航培训 | IT就业培训" itemprop="name">`
	- 搜索的描述
	 `<meta name="description" content="领航就业培训, 贴心为你量身打造, 挑战7万年薪,成就巅峰人生." />`
	- 搜索的关键字
	 `<meta name="keywords" content="领航, 教育, 墨尔本, 就业, 培训, iOS, Swift, PHP, SQL, IT, 工作, 墨尔本IT职业, 墨尔本IT工作, 墨尔本IT培训, 领航职业培训, 领航工作培训, 领航IT就业, 领航iOS就业班, 领航PHP就业班, " />`
	- 搜索的地理位置
	`<meta property="og:locale" content="zh_CN">` 

####Paragraphs

```
<p>This is a paragraph</p>
```
<p>This is a paragraph</p>

####Line Breaks `<br>`

```
<p>This is<br>a para<br>graph with line breaks</p>
```
<p>This is<br>a para<br>graph with line breaks</p>

#### Preformatted Text

```
<pre>
  My Bonnie lies over the ocean.

  My Bonnie lies over the sea.

  My Bonnie lies over the ocean.

  Oh, bring back my Bonnie to me.
</pre>
```
<pre>
  My Bonnie lies over the ocean.

  My Bonnie lies over the sea.

  My Bonnie lies over the ocean.

  Oh, bring back my Bonnie to me.
</pre>

####Hyperlinks超链接
```
<a href="http://www.google.com" target="_blank">Google</a>
```
<a href="http://www.google.com" target="_blank">Google</a>

- href分为绝对路径和相对路径
	- 绝对路径: 
		- 无论网页放在那里 都通过绝对路径找到文件
		- 网页链接(www.google.com)都属于绝对路径
	- 相对路径
		- 相对于网页的位置开始查找的路径 (css/main.css)
		- 需要链接的文件和网页放在同一个文件夹下 否则容易找不到文件

- `target="_blank"` 用来在新窗口或者新tab中打开链接

- 可以把图片转化为超链接
```
<a href="google.com">
  <img src="smiley.gif" alt="HTML tutorial" style="width:42px;height:42px;border:0">
</a>
```

####Image

```
<img src="google.png" alt="google logo" width="128" height="128">
```

####Table
表格是以`<table></table>`来声明 包括了
- th 标题
- tr 行
- td 单元格

由于邮件需要适应不同的屏幕尺寸, 而且用HTML写出来的邮件没有办法加在javascript等脚本 所以table可以让HTML Email完成自适应屏幕的最普遍的方法 ------ [HTML Email](http://webdesign.tutsplus.com/articles/build-an-html-email-template-from-scratch--webdesign-12770)

```
<table style="width:100%">
  <tr>
    <th>Firstname</th>
    <th>Lastname</th> 
    <th>Points</th>
  </tr>
  <tr>
    <td>Eve</td>
    <td>Jackson</td> 
    <td>94</td>
  </tr>
</table>
```
<table style="width:100%">
  <tr>
    <th>Firstname</th>
    <th>Lastname</th> 
    <th>Points</th>
  </tr>
  <tr>
    <td>Eve</td>
    <td>Jackson</td> 
    <td>94</td>
  </tr>
</table>

如果一个单元格占用了几列, 可以用`colspan= " "`来实现
```
<table style="width:100%">
  <tr>
    <th>Name</th>
    <th colspan="2">Telephone</th>
  </tr>
  <tr>
    <td>Bill Gates</td>
    <td>555 77 854</td>
    <td>555 77 855</td>
  </tr>
</table>
```
<table style="width:100%">
  <tr>
    <th>Name</th>
    <th colspan="2">Telephone</th>
  </tr>
  <tr>
    <td>Bill Gates</td>
    <td>555 77 854</td>
    <td>555 77 855</td>
  </tr>
</table>

如果一个单元格要占用几行, 可以用`rowspan=" "`来实现

```
<table style="width:100%">
  <tr>
    <th>Name:</th>
    <td>Bill Gates</td>
  </tr>
  <tr>
    <th rowspan="2">Telephone:</th>
    <td>555 77 854</td>
  </tr>
  <tr>
    <td>555 77 855</td>
  </tr>
</table>
```
<table style="width:100%">
  <tr>
    <th>Name:</th>
    <td>Bill Gates</td>
  </tr>
  <tr>
    <th rowspan="2">Telephone:</th>
    <td>555 77 854</td>
  </tr>
  <tr>
    <td>555 77 855</td>
  </tr>
</table>

table的标题可以用`<caption>`实现
 

```
<caption>Monthly savings</caption>
```

####Lists
列表分为有序的和无序的:
- 有序列表

```
<ol>
  <li>Coffee</li>
  <li>Tea</li>
  <li>Milk</li>
</ol>
```

<ol>
  <li>Coffee</li>
  <li>Tea</li>
  <li>Milk</li>
</ol>

有序列表的标示符可以用`type=" "`来修改
| 类型     |    说明 |
| :---------- | :--------| 
| `type="1"`  | 数字 | 
| `type="A"` | 大写字母| 
|`type="a"`|小写字母|
|`type="I"`|大写罗马数字|
|`type="i"`|小写罗马数字|

- 无序列表 
```
<ul>
  <li>Coffee</li>
  <li>Tea</li>
  <li>Milk</li>
</ul>
```
<ul>
  <li>Coffee</li>
  <li>Tea</li>
  <li>Milk</li>
</ul>

无序列表有不同的标识符 可以用`style="list-style-type:  "` 来实现:

```
<ul style="list-style-type:disc">
  <li>Coffee</li>
  <li>Tea</li>
  <li>Milk</li>
</ul>
```

<ul style="list-style-type:disc">
  <li>Coffee</li>
  <li>Tea</li>
  <li>Milk</li>
</ul>

```
<ul style="list-style-type:circle">
  <li>Coffee</li>
  <li>Tea</li>
  <li>Milk</li>
</ul>
```

<ul style="list-style-type:circle">
  <li>Coffee</li>
  <li>Tea</li>
  <li>Milk</li>
</ul>

```
<ul style="list-style-type:square">
  <li>Coffee</li>
  <li>Tea</li>
  <li>Milk</li>
</ul>
```

<ul style="list-style-type:square">
  <li>Coffee</li>
  <li>Tea</li>
  <li>Milk</li>
</ul>

```
<ul style="list-style-type:none">
  <li>Coffee</li>
  <li>Tea</li>
  <li>Milk</li>
</ul>
```
<ul style="list-style-type:none">
  <li>Coffee</li>
  <li>Tea</li>
  <li>Milk</li>
</ul>

####Block-level
- `<div>`
- `<h1>-<h6>`
- `<p>`
- `<form>`

```
<div style="background-color:black; color:white; padding:20px;">

<h2>London</h2>
<p>London is the capital city of England. It is the most populous city in the United Kingdom, with a metropolitan area of over 13 million inhabitants.</p>
</div>
```
<div style="background-color:black; color:white; padding:20px;">

<h2>London</h2>
<p>London is the capital city of England. It is the most populous city in the United Kingdom, with a metropolitan area of over 13 million inhabitants.</p>

</div>

####Inline
- `<span>`
-  `<a>`
-   `<img>`

```
<h1>My <span style="color:red">Important</span> Heading</h1>
```
<h1>My <span style="color:red">Important</span> Heading</h1>

####Layout
![Alt text](./img_sem_elements.gif)
|	类型	| 
| :----------: |
|	header	|
|	nav	|
|	section	|
|	article	|
|	aside	|
|	footer	|
|	details	|
|	summary	|



```
<!DOCTYPE html>
<html>
<head>
<style>
#header {
    background-color:black;
    color:white;
    text-align:center;
    padding:5px;
}
#nav {
    line-height:30px;
    background-color:#eeeeee;
    height:300px;
    width:100px;
    float:left;
    padding:5px;	      
}
#section {
    width:350px;
    float:left;
    padding:10px;	 	 
}
#footer {
    background-color:black;
    color:white;
    clear:both;
    text-align:center;
   padding:5px;	 	 
}
</style>
</head>
<body>

<div id="header">
<h1>City Gallery</h1>
</div>

<div id="nav">
London<br>
Paris<br>
Tokyo<br>
</div>

<div id="section">
<h2>London</h2>
<p>
London is the capital city of England. It is the most populous city in the United Kingdom,
with a metropolitan area of over 13 million inhabitants.
</p>
<p>
Standing on the River Thames, London has been a major settlement for two millennia,
its history going back to its founding by the Romans, who named it Londinium.
</p>
</div>

<div id="footer">
Copyright Navigation International
</div>

</body>
</html>
```

####iframe
如果要在网页中嵌入别的网页, 可以使用`<iframe src="URL"></iframe>` 来实现

```
<!DOCTYPE html>
<html>
<body>

<iframe width="100%" height="300px" src="demo_iframe.htm" name="iframe_a"></iframe>
<p><a href="http://www.google.com" target="iframe_a">google.com</a></p>

<p>When the target of a link matches the name of an iframe, the link will open in the iframe.</p>

</body>
</html>
```


###响应式布局
>由于现在电脑, 手机, 平板的尺寸多样化, 所以现在网页编程最主要的最基本的核心就是响应式布局, 目的是可以让网页自动识别用户的屏幕尺寸, 然后相应的完成格式的改变 ------ [自适应网页设计](http://www.ruanyifeng.com/blog/2012/05/responsive_web_design.html)

```
<!DOCTYPE html>
<html lang="en-us">
<head>
<style>
.city {
    float: left;
    margin: 5px;
    padding: 15px;
    width: 300px;
    height: 300px;
    border: 1px solid black;
} 
</style>
</head>
<body>

<h1>Responsive Web Design Demo</h1>

<div class="city">
  <h2>London</h2>
  <p>London is the capital city of England.</p>
  <p>It is the most populous city in the United Kingdom,
  with a metropolitan area of over 13 million inhabitants.</p>
</div>

<div class="city">
  <h2>Paris</h2>
  <p>Paris is the capital of France.</p> 
  <p>The Paris area is one of the largest population centers in Europe,
  with more than 12 million inhabitants.</p>
</div>

<div class="city">
  <h2>Tokyo</h2>
  <p>Tokyo is the capital of Japan.</p>
  <p>It is the center of the Greater Tokyo Area,
  and the most populous metropolitan area in the world.</p>
</div>

</body>
</html>
```

###Color
在HTML中, 我们可以用颜色的名字(`Red`), 十六进制编码(`#dbb76c`) 或者 RGB编码(`rgb(255,0,0)`)来选择颜色 ------ [w3schools color](http://www.w3schools.com/html/html_colornames.asp)

####Safe Colors
>Safe Colors是指在多年前计算机只支持256色的时候 所选出来的40个固定的系统颜色, 然而随着计算机的发展, 支持的颜色越来越多, 这概念现在已经不重要了.

###特殊字符
由于编程的原因, 很多特殊字符没办法直接显示, 需要使用特别的编码来显示这些特殊字符
|显示效果|名字|编码名字|编码数字|
|:----------:||:----------:|:----------:|:----------:|
|	|空格|&nbsp|&#160|
|<|小于|&lt|&#60|
|>|大于|&gt|&#62
|&|cent|&amp|&38|
|¢|cent|&cent|&#162|
|£|pound|&pound|&#163|
|¥|yen|&yen|&#165|
|€|euro|&euro|&#8364|
|©|copyright|&copy|&#169|
|®|registered trademark|&reg|&#174|

###XHTML
XHTML(可扩展超文本标记语言), 与HTML很类似, 但是更加严格. 结合了部分XML的功能和大多数HTML的简单特性.
XHTML与HTML的不同:
- XHTML元素必须正确的嵌套
错误的: `<b><i>This text is bold and italic</b></i>`
- XHTML必须被关闭
`<br /><hr />`
- 标签名必须小写
- XHTML文档必须有根元素
```
<html>
<head> ... </head>
<body> ... </body>
</html>
```
用[W3C Validator](https://validator.w3.org)来验证XHTML

###HTML Forms
表格
```
<form>
  First name:<br>
  <input type="text" name="firstname">
  <br>
  Last name:<br>
  <input type="text" name="lastname">
</form>
```
<form>
  First name:<br>
  <input type="text" name="firstname">
  <br>
  Last name:<br>
  <input type="text" name="lastname">
</form>
