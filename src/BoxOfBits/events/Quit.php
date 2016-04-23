<?php

/*
*  ____             ____   __ ____  _ _       
* |  _ \           / __ \ / _|  _ \(_) |      
* | |_) | _____  _| |  | | |_| |_) |_| |_ ___ 
* |  _ < / _ \ \/ / |  | |  _|  _ <| | __/ __|
* | |_) | (_) >  <| |__| | | | |_) | | |_\__ \
* |____/ \___/_/\_\\____/|_| |____/|_|\__|___/
* 
* The growing plugin with so many features
*
* @author BoxOfDevs Team
* @link http://boxofdevs.x10host.com/
* 
*/

namespace BoxOfBits\Events;

use BoxOfBits\Loader;
use BoxOfBits\utils\SymbolFormat;

use pocketmine\event\Listener;
use pocketmine\utils\TextFormat as TF;
use pocketmine\event\player\PlayerQuitEvent;

class Quit extends Loader implements Listener{
    
    public function onQuit(PlayerQuitEvent $event){
        $player = $event->getPlayer();
		$name = $player->getName();
		$line = "\n";
		$tip = str_replace("{player}", $name, $this->getConfig()->get("onQuitTip"));
		$tip = str_replace("{line}", $line, $this->getConfig()->get("onQuitTip"));
		if($tip === "disabled"){
			return false;
		}elseif(!$tip === "disabled"){
			$this->getServer()->broadcastTip($tip);
		}
		$popup = str_replace("{player}", $name, $this->getConfig()->get("onQuitPopup"));
		$popup = str_replace("{line}", $line, $this->getConfig()->get("onQuitPopup"));
		if($popup === "disabled"){
			return false;
		}elseif(!$popup === "disabled"){
			$this->getServer()->broadcastPopup($popup);
		}
		$message = str_replace("{player}", $name, $this->getConfig()->get("onQuitMessage"));
		$message = str_replace("{line}", $line, $this->getConfig()->get("onQuitMessage"));
		if($message === "disabled"){
			$event->setQuitMessage(false);
		}elseif(!$message === "disabled" || "default" ){
			$event->setQuitMessage($message);
		}
		if($player isOP()){
		    $optip = str_replace("{player}", $name, $this->getConfig()->get("OP-onQuitTip"));
			$optip = str_replace("{line}", $line, $this->getConfig()->get("OP-onQuitTip"));
			if($optip === "disabled"){
				return false;
			}elseif(!$optip === "disabled"){
				$this->getServer()->broadcastTip($optip);
			}
			$oppopup = str_replace("{player}", $name, $this->getConfig()->get("OP-onQuitPopup"));
			$oppopup = str_replace("{line}", $line, $this->getConfig()->get("OP-onQuitPopup"));
			if($oppopup === "disabled"){
				return false;
			}elseif(!$oppopup === "disabled"){
				$this->getServer()->broadcastPopup($oppopup);
			}
			$opmessage = str_replace("{player}", $name, $this->getConfig()->get("OP-onQuitMessage"));
			$opmessage = str_replace("{line}", $line, $this->getConfig()->get("OP-onQuitMessage"));
			if($opmessage === "disabled"){
				return false;
			}elseif(!$opmessage === "disabled" || "default" ){
				$event->setQuitMessage($opmessage);
			}
		}
        return $event;
    }

}

?>