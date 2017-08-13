<?php
namespace TheRoyalBlock\PlayerResizer
  
//Blocks
use pocketmine\block\Block;

//Command
use pocketmine\command\CommandSender;
use pocketmine\command\Command;

//Entity
use pocketmine\entity\Entity;
use pocketmine\entity\Effect;

//Events
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerItemHeldEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\event\entity\EntityLevelChangeEvent; 

//Inventory
use pocketmine\inventory\ChestInventory;
use pocketmine\inventory\EnderChestInventory;

//Item
use pocketmine\item\Item;

//Lang

//Level
use pocketmine\level\Level;
use pocketmine\level\Position;

//Math
use pocketmine\math\Vector3;

//Metadata

//Nbt
use pocketmine\nbt\NBT;

//Network
use pocketmine\network\Network;

//Permission
use pocketmine\permission\Permission;

//Plugin
use pocketmine\plugin\PluginBase;

//Scheduler
use pocketmine\scheduler\PluginTask;

//Tile
use pocketmine\tile\Sign;
use pocketmine\tile\Chest;

//Utils
use pocketmine\utils\TextFormat as C;
use pocketmine\utils\Config;

//Other
use pocketmine\Player;
use pocketmine\Server;

class Main extends PluginBase implements Listener{
    
  const PREFIX = C::GOLD . "[" . C::BLUE . "PlayerResizer" . C::GOLD . "] ". C::RESET . C::WHITE;
      public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getLogger()->info(self::PREFIX . "Plugin loaded!");
    }
      public function onDisable(){
        $this->getLogger()->info(self::PREFIX . "Plugin disabled!");
    }
  
  public function EntityLevelChangeEvent(EntityLevelChangeEvent $event){
    $player = $event->getEntity();
    $world = $event->getTarget()->getName();
    $worlds = new Config($this->getDataFolder() . "worlds.yml", Config::YAML);
    $worldstatus = $worlds->get($world);
    if($worldstatus == "revertsize"){
      $player->setScale(1);
      $player->sendMessage(self::PREFIX . "Your size has been reverted to its natural size: 1, as you entered " . $world);
    }else{
      return true;
    }
  }
  
  public function onCommand(CommandSender $sender, Command $cmd, $label, array $args){
  switch($cmd->getName()){
    case "":
    
