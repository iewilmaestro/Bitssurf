<?php
error_reporting(0);
if(file_exists('cookie.txt')){
	unlink('cookie.txt');
}
const 
title = "bitssurf",
versi = "1.0",
host = "www.bitssurf.com",
b = "\033[1;34m",
c = "\033[1;36m",
d = "\033[0m",
h = "\033[1;32m",
k = "\033[1;33m",
m = "\033[1;31m",
n = "\n",
p = "\033[1;37m",
u = "\033[1;35m";

function Curl($u, $h = 0, $p = 0, $x = 0) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $u);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
	curl_setopt($ch, CURLOPT_COOKIE,TRUE);
	curl_setopt($ch, CURLOPT_COOKIEFILE,"cookie.txt");
	curl_setopt($ch, CURLOPT_COOKIEJAR,"cookie.txt");
	if($p) {
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $p);
	}
	if($h) {
		curl_setopt($ch, CURLOPT_HTTPHEADER, $h);
	}
	if($x){
		curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, true);
		curl_setopt($ch, CURLOPT_PROXY, $x);
		// curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
	}
	curl_setopt($ch, CURLOPT_HEADER, true);
	$r = curl_exec($ch);
	$c = curl_getinfo($ch);
	if(!$c) return "Curl Error : ".curl_error($ch); else{
		$hd = substr($r, 0, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
		$bd = substr($r, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
		curl_close($ch);
		return array($hd,$bd);
	}
}
function Save($n){
	if(file_exists($n)){
		$d = file_get_contents($n);
	}else{
		$d = readline(m."Input ".$n.k." > ".h);
		file_put_contents($n,$d);
	}
	return $d;
}
function Bn(){
	system('clear');
	$m="\033[1;31m";$p="\033[1;37m";$k="\033[1;33m";$h="\033[1;32m";$u="\033[1;35m";$b="\033[1;34m";$c="\033[1;36m";$mp="\033[101m\033[1;37m";$cl="\033[0m";$mm="\033[101m\033[1;31m";$hp="\033[1;7m";
	$z=trim(strtoupper(title));
	$x=32;
	$y=strlen($z);
	$line=str_repeat('_',$x-$y);
	print "\n{$m}[{$p}Script{$m}]->{$k}[".$h.$z."{$k}]-[".$h.versi.$k."]".$p.$line.".\n{$u}.__              .__.__ 	                  {$p}| \n{$u}|__| ______  _  _|__|  |	\n|  |/ __ \ \/ \/ /  |  |\n|  \  ___/\     /|  |  |__\n|__|\___  >\/\_/ |__|____/\n        \/\n{$mm}[{$mp}▶{$mm}]{$cl} {$k}https://www.youtube.com/c/iewil\n{$c}{$hp} >_{$cl}{$b} Team-Function-INDO\n{$p}──────────────────────────────────────────────────\n";
}
function Line($x=0){
	$l = 50;
	if($x){
		return x($x,b.str_repeat('─',$l-3).n);
	}else{
		return b.str_repeat('─',$l).n;
	}
}
function tmr($tmr){
	$timr=time()+$tmr;
	while(true){
		print "\r                       \r";
		$res=$timr-time();
		if($res < 1){break;}
		print b."  | ".p.date('i:s',$res);sleep(1);
	}
}
function x($x,$str){
	cek:
	$arr = str_split(" script by iewil  ");
	$rst = count($arr);
	if($x >= $rst){
		$x = $x - $rst;
		goto cek;
	}
	if($x == 17){
		return " ".b."─".b."|".$str;
	}else{
		return " ".p.$arr[$x].b."|".$str;
	}
}
function h(){
	global $uagent;
	$h[] = "Host: ".host;
	$h[] = "accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9";
	$h[] = "user-agent: ".$uagent;
	return $h;
}
function uagent(){
	$url = "https://raw.githubusercontent.com/iewilmaestro/GudangDuit/main/ua.txt";
	$url = file_get_contents($url);
	preg_match_all("/(\s.*)/i",$url,$ua);
	$arr = array_filter($ua[1],'strlen');
	return trim($arr[array_rand($arr)]);
}
function RecaptchaV2($siteurl,$apikey){
	$sitekey = "6LeDnY4UAAAAADU25pfECqAtJp3Nf34NKs7ebR6W";
	$ua=["Host: api.anycaptcha.com","Content-Type: application/json"];
	$data=json_encode(array("clientKey"=>$apikey,"task"=>array("type"=>"RecaptchaV2TaskProxyless","websiteURL"=>$siteurl,"websiteKey"=>$sitekey,"isInvisible"=>false)));
	$Create=json_decode(curl('https://api.anycaptcha.com/createTask',$ua,$data)[1]);
	if($Create->errorId == '1'){
		return 0;
	}else{
		$Task=$Create->taskId;
		while(true){
			echo m."processing...";
			$base=json_encode(array("clientKey"=>$apikey,"taskId"=>$Task));
			$Result=json_decode(curl('https://api.anycaptcha.com/getTaskResult',$ua,$base)[1]);
			if($Result->status=='processing'){
				echo "\r             \r";
				echo m."processing......";
				sleep(5);
				echo "\r                \r";
				continue;
			}
			echo "\r             \r";
			return $Result->solution->gRecaptchaResponse;
		}
	}
}
function timezone(){
	$t = json_decode(file_get_contents("http://ip-api.com/json"),1)["timezone"];
	if($t){
		date_default_timezone_set($t);
	}
}
function login($username,$password,$apikey){
	$r = curl('https://www.bitssurf.com/login',h())[1];
	$csrf = explode('"',explode('name="csrfToken" value="',$r)[1])[0];
	$captcha = RecaptchaV2('https://www.bitssurf.com/login',$apikey);
	$data = [
		"csrfToken"		=> $csrf,
		"username"		=> $username,
		"password"		=> $password,
		"g-recaptcha-response"	=> $captcha,
		"remember"		=> "on"
	];
	return curl('https://www.bitssurf.com/login',h(),$data)[1];
}
timezone();
$uagent = uagent();
bn();
$username = Save('Username');
$password = Save('Password');
$apikey = Save('Apikey');
login($username,$password,$apikey);
bn();

$r = curl('https://www.bitssurf.com/account',h())[1];
$user = explode('"',explode('www.bitssurf.com/ref/',$r)[1])[0];
$bal = explode('</span>',explode('<span id="balance">',$r)[1])[0];
print x($x+=1,h."Username : ".k.$user.n);
print x($x+=1,h."Balance  : ".k.$bal.n);
print line($x+=1);

ulang:
while(true){
	$r = curl('https://www.bitssurf.com/faucet',h())[1];
	$tmr=explode(' * 1000)',explode('+ (',$r)[1])[0];
	if($tmr){
		tmr($tmr);
		goto ulang;
	}
	$csrf = explode('"',explode('name="csrfToken" value="',$r)[1])[0];
	$captcha = RecaptchaV2('https://www.bitssurf.com/faucet',$apikey);
	$data = [
		"csrfToken" 		=> $csrf,
		"g-recaptcha-response"	=> $captcha,
		"claim"			=> ""
	];
	$r = curl('https://www.bitssurf.com/faucet',h(),$data)[1];
	$notif=explode("',",explode("sendNotify('",$r)[1])[0];
	if($notif=="success"){
		$suk = explode("');",explode("sendNotify('success', '",$r)[1])[0];
		print x($x+=1,h.strip_tags($suk).n);
		$r = curl('https://www.bitssurf.com/account',h())[1];
		$bal = explode('</span>',explode('<span id="balance">',$r)[1])[0];
		print x($x+=1,c."[".u.date('H:i:s').c."]".h."Balance  : ".k.$bal.n);
		print line($x+=1);
	}elseif($notif=="danger"){
		$danger = trim(strip_tags(explode("');",explode("sendNotify('danger', '",$r)[1])[0]));
		if($danger=="You reached the maximum daily claims, get back tomorrow for more earnings."){
			print x($x+=1,m.$danger.n);
			exit;
		}
		print print x($x+=1,m.$danger.n);
		print line($x+=1);
	}
}
