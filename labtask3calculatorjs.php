<!DOCTYPE html>
<html>
<head>
<title>Simple Calculator</title>

<style>
body{
text-align:center;
font-family:Arial;
}

.calculator{
width:200px;
margin:auto;
border:1px solid black;
padding:10px;
}

button{
width:40px;
height:40px;
margin:3px;
}
</style>

</head>

<body>

<h2>Calculator</h2>

<div class="calculator">

<input type="text" id="display" style="width:170px;height:30px;"><br><br>

<button onclick="add('7')">7</button>
<button onclick="add('8')">8</button>
<button onclick="add('9')">9</button>
<button onclick="add('/')">/</button><br>

<button onclick="add('4')">4</button>
<button onclick="add('5')">5</button>
<button onclick="add('6')">6</button>
<button onclick="add('*')">*</button><br>

<button onclick="add('1')">1</button>
<button onclick="add('2')">2</button>
<button onclick="add('3')">3</button>
<button onclick="add('-')">-</button><br>

<button onclick="add('0')">0</button>
<button onclick="clearDisplay()">C</button>
<button onclick="calculate()">=</button>
<button onclick="add('+')">+</button>

</div>

<script>

function add(value){
document.getElementById("display").value += value;
}

function clearDisplay(){
document.getElementById("display").value = "";
}

function calculate(){
var result = eval(document.getElementById("display").value);
document.getElementById("display").value = result;
}

</script>

</body>
</html>