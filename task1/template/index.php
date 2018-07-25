
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <title>Title</title>


</head>

<body>

<form method="post">
<input type="text" name="number" placeholder="Enter some number" >

<input type="radio" checked id="soap"  name="method" value="soap">
    <label for="soap">soap</label>
    
  <input type="radio" id="curl"  name="method" value="curl">
    <label for="curl">curl</label>
<input type="submit">
</form>

<p>Convert number to string: <?php echo $value?></p>

<div>
    <form method="post"> 
     <select name="typeCalc">
        <option selected value="Add">Add</option>
        <option value="Subtract">Subtract</option>
        <option value="Multiply">Multiply</option>
        <option value="Divide">Divide</option>
     </select>
    <input type="text" name="intA" placeholder="Enter first number">
    <input type="text" name="intB" placeholder="Enter second number">

    <input type="radio" checked id="soap"  name="methodCalc" value="soap">
    <label for="soap">soap</label>
    
    <input type="radio" id="curl"  name="methodCalc" value="curl">
    <label for="curl">curl</label>
    <input type="submit">
    </form>
</div>
<p>result of calculator: <?php echo $calcValue;  ?></p>

</body>

</html>

