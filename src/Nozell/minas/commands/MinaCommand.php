<?php
 
namespace Nozell\minas\commands;

use pocketmine\player\Player;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use Nozell\minas\Loader;
use Nozell\minas\utils\PluginUtils;

class MinaCommand extends Command{

    public function __construct(){
        parent::__construct("minas", "Minas del server by §eNozell", null, ["mi"]);
        $this->setPermission("minas.nozell");
    }

    /**
     * @param CommandSender $sender
     * @param string $commandLabel
     * @param array $args
     * @return void
     */
    public function execute(CommandSender $sender, string $commandLabel, array $args){
        if(!$sender instanceof Player){
            $sender->sendMessage("Usa esto en el juego!");
            return;
        }

        if(!$sender->hasPermission("menu.nozell")){
            $sender->sendMessage(Loader::PREFIX. "§c¡No tienes permisos para esto!");
            return;
        }
    
   Loader::getInstance()->getMinas($sender);
            PluginUtils::PlaySound($sender, "random.chestopen", 1, 1);
            return;
        }
                }