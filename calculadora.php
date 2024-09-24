<?php
function isPublicIP($ip)
{
    if ($ip == null) {
        return false;
    }

    $octets = explode('.', $ip);
    $firstOctet = (int)$octets[0];

    if ($firstOctet == 10) {
        return false;
    }

    if ($firstOctet == 172 && (int)$octets[1] >= 16 && (int)$octets[1] <= 31) {
        return false;
    }

    if ($firstOctet == 192 && (int)$octets[1] == 168) {
        return false;
    }

    return true;
}

function getIPRange($ip, $mascara)
{
    if ($ip == null) {
        return null;
    }

    $ipOctetos = explode('.', $ip);
    $mascaraOctetos = explode('.', $mascara);

    $inicioIntervalo = array();
    $fimIntervalo = array();

    for ($i = 0; $i < 4; $i++) {
        $inicioIntervalo[$i] = (int)$ipOctetos[$i] & (int)$mascaraOctetos[$i];
        $fimIntervalo[$i] = $inicioIntervalo[$i] | (255 - (int)$mascaraOctetos[$i]);
    }

    // Incrementa o último octeto do endereço de rede
    $inicioIntervalo[3] += 1;

    // Decrementa o último octeto do endereço de broadcast
    $fimIntervalo[3] -= 1;

    $inicio = implode('.', $inicioIntervalo);
    $fim = implode('.', $fimIntervalo);

    return "$inicio - $fim";
}

function getBinaryIPRange($range)
{
    $rangeOctetos = explode('-', $range);
    $inicioBinario = implode('.', array_map(function ($octeto) {
        return str_pad(decbin((int)$octeto), 8, '0', STR_PAD_LEFT);
    }, explode('.', $rangeOctetos[0])));
    $fimBinario = implode('.', array_map(function ($octeto) {
        return str_pad(decbin((int)$octeto), 8, '0', STR_PAD_LEFT);
    }, explode('.', $rangeOctetos[1])));

    return "$inicioBinario - $fimBinario";
}

function getBroadcastAddress($ip, $mascara)
{
    if ($ip == null) {
        return null;
    }

    $ipOctetos = explode('.', $ip);
    $mascaraOctetos = explode('.', $mascara);

    $broadcast = array();

    for ($i = 0; $i < 4; $i++) {
        $broadcast[$i] = (int)$ipOctetos[$i] | (255 - (int)$mascaraOctetos[$i]);
    }

    return implode('.', $broadcast);
}

function getBinaryIP($ip)
{
    $ipOctetos = explode('.', $ip);

    return implode('.', array_map(function ($octeto) {
        return str_pad(decbin((int)$octeto), 8, '0', STR_PAD_LEFT);
    }, $ipOctetos));
}

function getNetworkAddress($ip, $mascara)
{
    if ($ip == null) {
        return null;
    }

    $ipOctetos = explode('.', $ip);
    $mascaraOctetos = explode('.', $mascara);

    $network = array();

    for ($i = 0; $i < 4; $i++) {
        $network[$i] = (int)$ipOctetos[$i] & (int)$mascaraOctetos[$i];
    }

    return implode('.', $network);
}

function getBinaryNetworkAddress($ip, $mascara)
{
    $networkAddress = getNetworkAddress($ip, $mascara);

    return getBinaryIP($networkAddress);
}

function getClass($ip)
{
    $octets = explode('.', $ip);
    $firstOctet = (int)$octets[0];

    if ($firstOctet >= 1 && $firstOctet <= 126) {
        return 'A';
    } elseif ($firstOctet >= 128 && $firstOctet <= 191) {
        return 'B';
    } elseif ($firstOctet >= 192 && $firstOctet <= 223) {
        return 'C';
    } elseif ($firstOctet >= 224 && $firstOctet <= 239) {
        return 'D';
    } elseif ($firstOctet >= 240 && $firstOctet <= 255) {
        return 'E';
    } else {
        return 'Desconhecida';
    }
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $ip = $_POST["ip"];
    $subrede = (int)$_POST["subrede"];

    // Calculate IP information
    $mascaraBinaria = str_repeat('1', $subrede) . str_repeat('0', 32 - $subrede);
    $mascaraFormatada = implode('.', array_map(function ($octeto) {
        return bindec($octeto);
    }, str_split($mascaraBinaria, 8)));

    $ipBinario = getBinaryIP($ip);
    $ipRede = getNetworkAddress($ip, $mascaraFormatada);
    $ipRedeBinario = getBinaryNetworkAddress($ip, $mascaraFormatada);

    // Cálculo do número de hosts
    $totalHosts = pow(2, 32 - $subrede); // Total de endereços disponíveis, incluindo o endereço de rede e o broadcast
    $applicableHosts = $totalHosts - 2; // Descontando o endereço de rede e o broadcast

    $range = getIPRange($ipRede, $mascaraFormatada) ?? '';
    $rangeBinario = getBinaryIPRange($range);
    $broadcast = getBroadcastAddress($ipRede, $mascaraFormatada) ?? '';
    $broadcastBinario = getBinaryIP($broadcast);

    $isPublic = isPublicIP($ip);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculatora De IPv4</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<nav class="topbar">
    <ul>
        <li><a href="index.html#home">Inicio</a></li>
        <li><a href="index.html#sobre">Sobre</a></li>
        <li><a href="index.html#projetos">Projetos</a></li>
        <li><a href="index.html#contatos">Contatos</a></li>
    </ul>
</nav>


    <div id="splash-screen" style="background-image: url('imagens/terry-vlisidis-WsEbnsnKbUE-unsplash.jpg'); background-size: cover; background-position: center; filter: brightness(0.5);">
        <h1>Calculadora de ip</h1>
        <p>A Carregar...</p>
    </div>

    <div class="calculadora">
        <h1>Calculatora De IPv4</h1>
        <nav>
</nav>

        <form method="post">
            <label for="ip">Digite o endereço IP:</label>
            <input type="text" id="ip" name="ip" value="<?php echo isset($ip) ? $ip : ''; ?>" required>
            <label for="subrede">Digite o número de bits da sub-rede:</label>
            <input type="number" id="subrede" name="subrede" min="0" max="32" value="<?php echo isset($subrede) ? $subrede : ''; ?>" required>
            <button type="submit">Calcular</button>
        </form>
        <div class="result-calculadora">
            <h2>Informações do IP</h2>
            <?php
            if (isset($ip)) {
                echo "<p>IP: $ip</p>";
                echo "<p>Máscara: $mascaraFormatada</p>";
                echo "<p>IP em binário: $ipBinario</p>";
                echo "<p>Rede: $ipRede</p>";
                echo "<p>Rede em binário: $ipRedeBinario</p>";
                echo "<p>Número total de hosts: $totalHosts</p>";
                echo "<p>Número de hosts aplicáveis na rede: $applicableHosts</p>";
                echo "<p>Intervalo de IPs: $range</p>";
                echo "<p>Intervalo de IPs em binário: $rangeBinario</p>";
                echo "<p>Broadcast: $broadcast</p>";
                echo "<p>Broadcast em binário: $broadcastBinario</p>";
                echo "<p>Classe: " . getClass($ip) . "</p>";
                echo "<p>É um IP público? " . ($isPublic ? 'Sim' : 'Não') . "</p>";
            }
            ?>
        </div>
    </div>
    <script src="time.js"></script>
    <script src="scroolbar.js"></script>
</body>
</html>

