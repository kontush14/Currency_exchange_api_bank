<?php
    require "db.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Currency rates of PrivatBank</title>
</head>
<body>
<?php
    $response = file_get_contents("https://api.privatbank.ua/p24api/pubinfo?json&exchange&coursid=5");
    $response = json_decode($response, true);
?>
<h1>Currency rates of PrivatBank</h1>
<table border="1">
        <thead>
            <tr>
                <th>Currency code</th>
                <th>National currency code</th>
                <th>Purchase rate</th>
                <th>Selling rate</th>
            </tr>
        </thead>
        <tfoot>
                <th>Currency code</th>
                <th>National currency code</th>
                <th>Purchase rate</th>
                <th>Selling rate</th>
        </tfoot>
        <tbody>
            <?php
                foreach($response as $val) :;
            ?>
            <tr>
                <?php
                    foreach($val as $td) :;
                ?>
                <td>
                    <?php
                        echo $td;
                    ?>
                </td>
                <?php
                    endforeach;
                ?>
            </tr>
            <?php
                endforeach;
            ?>
        </tbody>
    </table>
    <br>
    <?php
        $dollar_to_uah = $response['0'] ['buy'];

        $euro_to_uah = $response['1'] ['buy'];

        $rub_to_uah = $response['2'] ['buy'];

        $btc_to_dollar = $response['3'] ['buy'];
        
        $uah_to_usd = 1 / $response['0'] ['buy'];
        
        $btc_to_uah = $response['3'] ['buy'] / $uah_to_usd;
    
        $uah_to_eur = 1 / $response['1'] ['buy'];
        
        $uah_to_rub = 1 / $response['2'] ['buy'];
        
        $euro = $response['1'] ['buy'];
        $dollar = $response['0'] ['buy'];
        $euro_to_dollar = $euro / $dollar;

        $dollar_to_euro = $dollar / $euro;
        
        $rub = $response['2'] ['buy'];
        $euro_to_rub = $euro / $rub;
        
        $rub_to_euro = $rub / $euro;
        
        $dollar_to_rub = $dollar / $rub;
        
        $rub_to_dollar = $rub / $dollar;
        
    ?>
    <br>
    <form method = "POST" action = "currencyapi.php">
    Select the currency conversion option (purchase rate):
            <select class = "form-control"  name = "currency">
                <option value = "UAH/USD">UAH/USD</option>
                <option value = "UAH/EUR">UAH/EUR</option>
                <option value = "UAH/RUB">UAH/RUB</option>
                <option value = "USD/UAH">USD/UAH</option>
                <option value = "EUR/UAH">EUR/UAH</option>
                <option value = "RUB/UAH">RUB/UAH</option>
                <option value = "EUR/USD">EUR/USD</option>
                <option value = "EUR/RUB">EUR/RUB</option>
                <option value = "USD/EUR">USD/EUR</option>
                <option value = "RUB/EUR">RUB/EUR</option>
                <option value = "USD/RUB">USD/RUB</option>
                <option value = "RUB/USD">RUB/USD</option>
            </select>
            <br>
            Enter the amount (purchase rate):
            <input type = "text" name = "amount">
            <br>
            <input type = "submit" value = "Conversion">
            <br>
            <?php
                $amount = $_POST['amount'];
                if($_POST['amount'] > 0)
                {
                    $valor = isset($_POST['currency']) ? $valor = $_POST['currency'] : 0;
                    switch($valor)
                    {
                        case "UAH/USD" : 
                            echo $uah_to_usd * $amount . "USD"; 
                            break;
                        case "UAH/EUR" :
                            echo $uah_to_eur * $amount . "EUR";
                            break;
                        case "UAH/RUB" :
                            echo $uah_to_rub * $amount . "RUB";
                            break;
                        case "USD/UAH":
                            echo $dollar_to_uah * $amount . "UAH";
                            break;
                        case "EUR/UAH":
                            echo $euro_to_uah * $amount . "UAH";
                            break;
                        case "RUB/UAH":
                            echo $rub_to_uah * $amount . "UAH";
                            break;
                        case "EUR/USD":
                            echo $euro_to_dollar * $amount . "USD";
                            break;
                        case "USD/EUR":
                            echo $dollar_to_euro * $amount . "EUR";
                            break;
                        case "RUB/EUR":
                            echo $rub_to_euro * $amount . "EUR";
                            break;
                        case "USD/RUB":
                            echo $dollar_to_rub * $amount . "RUB";
                            break;
                        case "RUB/USD":
                            echo $rub_to_dollar * $amount . "USD";
                            break;
                        case "EUR/RUB":
                            echo $euro_to_rub * $amount . "RUB";
                            break;
                    }
                }
                else
                {
                    echo "Please enter the correct number";
                }
            ?>
        </form>
        <br>
        <?php
        $dollar_to_uah_2 = $response['0'] ['sale'];//conversion from dollar to hryvnia

        $euro_to_uah_2 = $response['1'] ['sale'];//conversion from euro to hryvnia

        $rub_to_uah_2 = $response['2'] ['sale'];//conversion from ruble to hryvnia

        $btc_to_dollar_2 = $response['3'] ['sale'];//conversion from bitcoin to dollars
        
        $uah_to_usd_2 = 1 / $response['0'] ['sale'];//conversion from hryvnia to dollars
        
        $btc_to_uah_2 = $response['3'] ['sale'] / $uah_to_usd;//conversion from bitcoin to hryvnia
        
        $uah_to_eur_2 = 1 / $response['1'] ['sale'];//conversion from hryvnia to euro
        
        $uah_to_rub_2 = 1 / $response['2'] ['sale'];//conversion from hryvnia to rubles
        
        $euro_2 = $response['1'] ['sale'];
        $dollar_2 = $response['0'] ['sale'];
        $euro_to_dollar_2 = $euro_2 / $dollar_2;//conversion from euros to dollars

        $dollar_to_euro_2 = $dollar_2 / $euro_2;//converting from dollars to euros
        
        $rub_2 = $response['2'] ['sale'];
        $euro_to_rub_2 = $euro_2 / $rub_2;//conversion from euro to rubles
        
        $rub_to_euro_2 = $rub_2 / $euro_2;//conversion from rubles to euro
        
        $dollar_to_rub_2 = $dollar_2 / $rub_2;//conversion from dollars to rubles
        
        $rub_to_dollar_2 = $rub_2 / $dollar_2;//conversion from rubles to dollars
        
    ?>
    <br>
    <form method = "POST" action = "currencyapi.php">
        Select the currency conversion option (selling rate):
            <select class = "form-control"  name = "currency">
                <option value = "UAH/USD">UAH/USD</option>
                <option value = "UAH/EUR">UAH/EUR</option>
                <option value = "UAH/RUB">UAH/RUB</option>
                <option value = "USD/UAH">USD/UAH</option>
                <option value = "EUR/UAH">EUR/UAH</option>
                <option value = "RUB/UAH">RUB/UAH</option>
                <option value = "EUR/USD">EUR/USD</option>
                <option value = "EUR/RUB">EUR/RUB</option>
                <option value = "USD/EUR">USD/EUR</option>
                <option value = "RUB/EUR">RUB/EUR</option>
                <option value = "USD/RUB">USD/RUB</option>
                <option value = "RUB/USD">RUB/USD</option>
            </select>
            <br>
            Enter the amount (selling rate):
            <input type = "text" name = "amount_2">
            <br>
            <input type = "submit" value = "Conversion">
            <br>
            <?php
                $amount = $_POST['amount_2'];
                if($_POST['amount_2'] > 0)
                {
                    $valor = isset($_POST['currency']) ? $valor = $_POST['currency'] : 0;
                    switch($valor)
                    {
                        case "UAH/USD" : 
                            echo $uah_to_usd_2 * $amount . "USD"; 
                            break;
                        case "UAH/EUR" :
                            echo $uah_to_eur_2 * $amount . "EUR";
                            break;
                        case "UAH/RUB" :
                            echo $uah_to_rub_2 * $amount . "RUB";
                            break;
                        case "USD/UAH":
                            echo $dollar_to_uah_2 * $amount . "UAH";
                            break;
                        case "EUR/UAH":
                            echo $euro_to_uah_2 * $amount . "UAH";
                            break;
                        case "RUB/UAH":
                            echo $rub_to_uah_2 * $amount . "UAH";
                            break;
                        case "EUR/USD":
                            echo $euro_to_dollar_2 * $amount . "USD";
                            break;
                        case "USD/EUR":
                            echo $dollar_to_euro_2 * $amount . "EUR";
                            break;
                        case "RUB/EUR":
                            echo $rub_to_euro_2 * $amount . "EUR";
                            break;
                        case "USD/RUB":
                            echo $dollar_to_rub_2 * $amount . "RUB";
                            break;
                        case "RUB/USD":
                            echo $rub_to_dollar_2 * $amount . "USD";
                            break;
                        case "EUR/RUB":
                            echo $euro_to_rub_2 * $amount . "RUB";
                            break;
                    }
                }
                else
                {
                    echo "Please enter the correct number";
                }
            ?>
        </form>
        <br>
        <br>
    <a href = "/logout.php">log out</a>
</body>
</html>

