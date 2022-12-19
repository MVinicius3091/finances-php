<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css" type="text/css">
    <title>Finanças com php</title>
</head>
<body>
    
    <section class="form-content">
        <form method="POST">
            <div>
                <label for="valor">Valor</label>
                <input type="text" name="valor" id="valor" placeholder="R$ 0,00" maxlength="14" />
            </div>                

            <div>
                <label for="parcelas">Parcelas</label>
                <select name="parcelas" id="parcelas">
                    <option value="12">12</option>
                    <option value="24">24</option>
                    <option value="36">36</option>
                    <option value="48">48</option>
                </select>
            </div>

            <div>
                <label for="juros">Juros/mês</label>
                <input type="text" name="juros" id="juros" maxlength="6" />
            </div>

            <button id="simular" name="simular">Simular</button>
        </form>
    </section>

    <section class="table-content">
        <table cellspacing="3" cellpadding="4">
            <thead>
                <tr>
                    <th>Nº parcelas</th>
                    <th>Taxa/Juros</th>
                    <th>Juros/Mês</th>
                    <th>Valor</th>
                </tr>
            </thead>

            <tbody id="resultado">

            </tbody>
        </table>
    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
    <script src="https://plentz.github.io/jquery-maskmoney/javascripts/jquery.maskMoney.min.js" type="text/javascript"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.12/jquery.mask.min.js"></script> -->
    <script src="./js/script.js"></script>
</body>
</html>