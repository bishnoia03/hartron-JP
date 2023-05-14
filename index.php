<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JP</title>
    <?php
    include 'db.php';
    ?>
</head>
<body>
    <form action="" method="post">
    <?php
    $sql = 'select * from agent_master';
    $result = $conn->query($sql);
    ?>
    <label for="">Select Agent Name</label><br>
        <select name="agent_no" id="">
            
            <?php
                while($row = $result->fetch_assoc()){
                ?>
            <option value="<?php echo $row["Agent_No"] ?>
            "><?php echo $row["Agent_Name"] ?></option>
            <?php
                }
            ?>
        </select><br><br>
        <label for="">Enter Date</label><br>
        <input type="date" name="date"><br><br>
        <label for="">Customer Name</label><br>
        <input type="text" placeholder="Customer Name" name="customer_name"><br><br>
        <label for="">Enter policy Amount</label><br>
        <input type="number" placeholder="Enter Policy Amount" id="amount" name="policy_amount" onkeyup="myfun()"><br><br>
        <label for="">Commission Auto Calculated</label><br>
        <input type="number" placeholder="Commission" id="commission" readonly name="commission"><br><br>
        <input type="submit" name="submit" value="submit">
    </form>
    <?php
        if(isset($_POST['submit']))
        {
            $agent_no = $_POST['agent_no'];
            $policy_date = $_POST['date'];
            $customer_name = $_POST['customer_name'];
            $policy_amount = $_POST['policy_amount'];
            $commission = $_POST['commission'];
            $sql1 = "insert into policy_details(Agent_No,PolicyDate,CustomerName,PolicyAmount,Commission) values ('$agent_no','$policy_date','$customer_name','$policy_amount','$commission')";
            $result1 = $conn->query($sql1);
        }
        ?>
        
<button onclick="myfun2()">Show Report</button>

<form action="" method="post" >
    <table border=1 id="mytable" style="display:none;">
    <thead>
        <td>Agent</td>
        <td>Policy Date</td>
        <td>Policy Amount</td>
        <td>Commission</td>
    </thead>
    <?php
        $sql2 = 'select * from policy_details join agent_master on agent_master.Agent_No = policy_details.Agent_No';
        $result2 = $conn->query($sql2);
        while($row3 = $result2->fetch_assoc())
        {
    ?>
    <tr>
       
        <td><?php echo $row3['Agent_Name'] ?></td>
        <td><?php echo $row3['PolicyDate'] ?></td>
        <td><?php echo $row3['PolicyAmount'] ?></td>
        <td><?php echo $row3['Commission'] ?></td>
       
    </tr>
    <?php
        }
    ?>
</table>
</form>
</body>
</html>
<script>
   function myfun()
   {
    var commission;
    var amount = document.getElementById("amount").value;
    if(amount<10000)
    {
        commission = (amount*2)/100;
        document.getElementById("commission").value = commission;
    }
    else if(amount>10000)
    {
        commission = (amount*2.5)/100;
        document.getElementById("commission").value = commission;
    }
   }
   function myfun2()
   {
    var x = document.getElementById("mytable");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
   }

</script>