<?php
namespace CustomMessages;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;

class Main extends PluginBase implements Listener{
    public function onEnable(){
        $this->saveDefaultConfig();
        $cfg = $this->getConfig();
        if(!$cfg->exists("joinmessage")){
            $cfg->set("joinmessage", "@player joined the server! :3");
        }
        if(!$cfg->exists("quitmessage")){
            $cfg->set("quitmessage", "@player leave the server :(");
        }

        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getLogger()->info(TextFormat::AQUA . "Everything loaded!");
    }

    /**
     * @param PlayerJoinEvent $event
     */
    public function onPlayerJoin(PlayerJoinEvent $event){
        $message = $this->getConfig()->get("joinmessage");
        $message = str_replace("@player", $event->getPlayer()->getDisplayName(), $message);
        $event->setJoinMessage($message);
    }

    /**
     * @param PlayerQuitEvent $event
     */
    public function onPlayerQuit(PlayerQuitEvent $event){
        $message = $this->getConfig()->get("quitmessage");
        $message = str_replace("@player", $event->getPlayer()->getDisplayName(), $message);
        $event->setQuitMessage($message);
    }
} 