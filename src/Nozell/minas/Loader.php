<?php
    
# The creator of this plugin was Nozell.
# https://youtube.com/@vNozell
 
namespace Nozell\minas;

use pocketmine\Server;
use pocketmine\player\Player;

use pocketmine\plugin\PluginBase;

use pocketmine\utils\Config;

use Vecnavium\FormsUI\SimpleForm;

use Nozell\minas\utils\PluginUtils;
use Nozell\minas\commands\MinaCommand;
use Nozell\minas\commands\SoundCommand;

class Loader extends PluginBase{

    /** @var Config $config */
    public Config $config;

    public static Loader $instance;

    public const PREFIX = "";

    /**
     * @return void
     */
    public function onLoad(): void{
        self::$instance = $this;
    }

    /**
     * @return void
     */
    public function onEnable(): void{
        $this->saveResource("config.yml");
        $this->config = new Config($this->getDataFolder() . "config.yml");
        Server::getInstance()->getCommandMap()->register("minas", new MinaCommand());
        Server::getInstance()->getCommandMap()->register("sound", new SoundCommand());
    }
    /**
     * @param Player $player
     * @return void
     */
    public function getMinas(Player $player): void{
        $form = new SimpleForm(function(Player $player, $data){
            if($data === null){
                PluginUtils::PlaySound($player, "random.chestclosed", 1, 1);
                return true;
            }
            switch($data){
                case 0: #mina normal
                    $command = $this->config->getNested("Comandos.mina");
                    $player->getServer()->dispatchCommand($player, $command);
                    PluginUtils::PlaySound($player, "random.pop2", 1, 1.5);
                break;

                case 1: #minapvp
                    $command = $this->config->getNested("Comandos.minapvp");
                    $player->getServer()->dispatchCommand($player, $command);
                    PluginUtils::PlaySound($player, "random.pop2", 1, 1.5);
                break;
                case 2: //help
                    $this->getHelpminas($player);
                    
 PluginUtils::PlaySound($player, "random.pop2", 1, 1.5);
                break;

                case 3: // CERRAR
                    PluginUtils::PlaySound($player, "random.chestclosed", 1, 1);
                break;

            }
        });
        $form->setTitle("    ");
        $form->setContent("§eElige la categoria que deseas utlizar:");
        $form->addButton("§l§3Mina\n§r§fHaga clic",0,"textures/runes/rare_rune");
        $form->addButton("§l§4MinaPvP\n§r§fHaga clic",0,"textures/runes/mythical_rune");
        $form->addButton("§l§6Help \n§r§fHaga click",0,"textures/ui/book_addtextpage_default");
        $form->addButton("§l§4CERRAR \n§r§0Haga clic",0,"textures/ui/cancel");
        $player->sendForm($form);
    }
    /**
     *@param Player $player
     * @return void
     */
    public function getHelpminas(Player $player): void{ 
    $form = new
SimpleForm(function(Player $player, $data){
         if($data === null){
             return true;
         }
         switch($data){
             case 0:
                 $this->getMinas($player);
                 
PluginUtils::PlaySound($player, "random.chestclosed", 1, 1);
                 break;
         }
    });
    $form->setTitle("");
    $form->setContent(str_replace(["{LINE}"], ["\n"], $this->config->getNested("help.mina")));
    $form->addButton("§l§4VOLVER\n§r§fHaga click",0,"textures/ui/cancel");
        $player->sendForm($form);
    }
    /**
     * @return Loader
     */
    public static function getInstance(): Loader{
        return self::$instance;
    }
}
