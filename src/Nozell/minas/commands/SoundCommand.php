<?php
    
#      _       ____   __  __ 
#     / \     / ___| |  \/  |
#    / _ \   | |     | |\/| |
#   / ___ \  | |___  | |  | |
#  /_/   \_\  \____| |_|  |_|
# The creator of this plugin was fernanACM.
# https://github.com/fernanACM
 
namespace Nozell\minas\commands;

use pocketmine\player\Player;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use Nozell\minas\Loader;
use Nozell\minas\utils\PluginUtils;
use Nozell\minas\utils\WarpUtils;

class SoundCommand extends Command{


    public function __construct(){
        parent::__construct("sound", "sound", null, ["sn", "sn", "sn"]);
        $this->setPermission("sound.nz");
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

        if(!$sender->hasPermission("sound.nz")){
            $sender->sendMessage(Loader::PREFIX. "§c¡No tienes permisos para esto!");
            return;
        }
        $sender->sendMessage("§p¡Te has ganado un premio Exelente! ¡Enhorabuena! ");
        
PluginUtils::PlaySound($sender, "random.levelup", 1, 1);
    }
}