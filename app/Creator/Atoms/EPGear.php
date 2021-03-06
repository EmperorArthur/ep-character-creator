<?php
declare(strict_types=1);

namespace App\Creator\Atoms;

/**
 * The character's gear.
 *
 * This includes morph implants, soft-gear used by the ego, and any additional item on anything.
 *
 * TODO: Subclass this to handle those cases separately.  Armor, weapons, misc physical goods, and soft gear are all extremely different things
 * Note: Implants are often just regular gear, so probably worth converting to an 'isImplant' bool
 *
 * @author reinhardt
 */
class EPGear extends EPAtom{
            
    static $SOFT_GEAR = "SOF";
    static $STANDARD_GEAR = "STD";
    static $WEAPON_MELEE_GEAR = "WMG";
    static $WEAPON_ENERGY_GEAR = "WEG";
    static $WEAPON_KINETIC_GEAR = "WKG";
    static $WEAPON_SPRAY_GEAR = "WSG";
    static $WEAPON_EXPLOSIVE_GEAR = "WXG";
    static $WEAPON_SEEKER_GEAR = "WSE";
    static $WEAPON_AMMUNITION = "WAM";
    static $WEAPON_ACCESSORY = "WAC";
    static $ARMOR_GEAR = "ARM";
    static $IMPLANT_GEAR = "IMG";
    static $DRUG_GEAR = "DRG";
    static $CHEMICALS_GEAR = "CHG";
    static $POISON_GEAR = "POG";
    static $PET_GEAR = "PEG";
    static $VEHICLES_GEAR = "VEG";
    static $ROBOT_GEAR = "ROG";
    
    //not used on the database
    static $FREE_GEAR = "FRE";
    
    //GUI use for filtering the listes
    static $CAN_USE_EVERYBODY = 'EVERY';
    static $CAN_USE_BIO = 'BIO';
    static $CAN_USE_BIO_POD = 'BIOPOD';
    static $CAN_USE_SYNTH_POD = 'SYNTHPOD';
    static $CAN_USE_SYNTH = 'SYNTH';
    static $CAN_USE_POD = 'POD';
    static $CAN_USE_CREATE_ONLY = 'CREATION';//useful for hiding gear
    
    public $armorEnergy;
    public $armorKinetic;

    /**
     * The amount of damage a weapon/ammo does
     * TODO:  Rename this
     * @var string
     */
    public $degat;
    public $armorPenetration;

    /**
     * An Enum of most static/const values, except the $CAN_USE ones
     * @var string
     */
    public $gearType;

    /**
     * An Enum of the $CAN_USE static/const values
     * @var string
     */
    public $gearRestriction;
        
    public $armorPenetrationMorphMod;
    public $degatMorphMod;
    public $armorEnergyMorphMod;
    public $armorKineticMorphMod;
    
    public $armorPenetrationTraitMod;
    public $degatTraitMod;
    public $armorEnergyTraitMod;
    public $armorKineticTraitMod;
    
    public $armorPenetrationBackgroundMod;
    public $degatBackgroundMod;
    public $armorEnergyBackgroundMod;
    public $armorKineticBackgroundMod;
    
    public $armorPenetrationFactionMod;
    public $degatFactionMod;
    public $armorEnergyFactionMod;
    public $armorKineticFactionMod;   
    
    public $armorPenetrationSoftgearMod;
    public $degatSoftgearMod;
    public $armorEnergySoftgearMod;
    public $armorKineticSoftgearMod;
    
    public $armorPenetrationPsyMod;
    public $degatPsyMod;
    public $armorEnergyPsyMod;
    public $armorKineticPsyMod;

    /**
     * @var bool If the player can own more than one (NOTE:  Even if they can, it's just incrementing the "occurrence" variable)
     */
    private $unique;

    /**
     * @var int The number of this item the player owns
     */
    private $occurrence = 1;

    //array
    public $bonusMalus;
    
    function getSavePack(): array
    {
        $savePack = parent::getSavePack();
		
        $savePack['armorEnergy'] =  $this->armorEnergy;
        $savePack['armorKinetic'] =  $this->armorKinetic;
        $savePack['degat'] =  $this->degat;
        $savePack['armorPenetration'] =  $this->armorPenetration;
        $savePack['gearType'] =  $this->gearType;
        $savePack['gearRestriction'] =  $this->gearRestriction;
        $savePack['armorPenetrationMorphMod'] =  $this->armorPenetrationMorphMod;
        $savePack['degatMorphMod'] =  $this->degatMorphMod;
        $savePack['armorEnergyMorphMod'] =  $this->armorEnergyMorphMod;
        $savePack['armorKineticMorphMod'] =  $this->armorKineticMorphMod;
        $savePack['armorPenetrationTraitMod'] =  $this->armorPenetrationTraitMod;
        $savePack['degatTraitMod'] =  $this->degatTraitMod;
        $savePack['armorEnergyTraitMod'] =  $this->armorEnergyTraitMod;
        $savePack['armorKineticTraitMod'] =  $this->armorKineticTraitMod;
        $savePack['armorPenetrationBackgroundMod'] =  $this->armorPenetrationBackgroundMod;
        $savePack['degatBackgroundMod'] =  $this->degatBackgroundMod;
        $savePack['armorEnergyBackgroundMod'] =  $this->armorEnergyBackgroundMod;
        $savePack['armorKineticBackgroundMod'] =  $this->armorKineticBackgroundMod;
        $savePack['armorPenetrationFactionMod'] =  $this->armorPenetrationFactionMod;
        $savePack['degatFactionMod'] =  $this->degatFactionMod;
        $savePack['armorEnergyFactionMod'] =  $this->armorEnergyFactionMod;
        $savePack['armorKineticFactionMod'] =  $this->armorKineticFactionMod;   
        $savePack['armorPenetrationSoftgearMod'] =  $this->armorPenetrationSoftgearMod;
        $savePack['degatSoftgearMod'] =  $this->degatSoftgearMod;
        $savePack['armorEnergySoftgearMod'] =  $this->armorEnergySoftgearMod;
        $savePack['armorKineticSoftgearMod'] =  $this->armorKineticSoftgearMod;
        $savePack['armorPenetrationPsyMod'] =  $this->armorPenetrationPsyMod;
        $savePack['degatPsyMod'] =  $this->degatPsyMod;
        $savePack['armorEnergyPsyMod'] =  $this->armorEnergyPsyMod;
        $savePack['armorKineticPsyMod'] =  $this->armorKineticPsyMod;
        $savePack['unique'] = $this->unique;
        $savePack['occurrence'] = $this->occurrence;
        $bmSavePacks = array();
        foreach($this->bonusMalus as $m){
            array_push($bmSavePacks	, $m->getSavePack());
        }
        $savePack['bmSavePacks'] = $bmSavePacks;

        return $savePack;
    }

    /**
     * @param array $an_array
     * @return EPGear
     */
    public static function __set_state(array $an_array)
    {
        $object = new self((string)$an_array['name'], '', '', 0);
        parent::set_state_helper($object, $an_array);

        $object->armorEnergy                   = (int)$an_array['armorEnergy'];
        $object->armorKinetic                  = (int)$an_array['armorKinetic'];
        $object->degat                         = (string)$an_array['degat'];
        $object->armorPenetration              = (int)$an_array['armorPenetration'];
        $object->gearType                      = (string)$an_array['gearType'];
        $object->gearRestriction               = (string)$an_array['gearRestriction'];
        $object->armorPenetrationMorphMod      = $an_array['armorPenetrationMorphMod'];
        $object->degatMorphMod                 = $an_array['degatMorphMod'];
        $object->armorEnergyMorphMod           = $an_array['armorEnergyMorphMod'];
        $object->armorKineticMorphMod          = $an_array['armorKineticMorphMod'];
        $object->armorPenetrationTraitMod      = $an_array['armorPenetrationTraitMod'];
        $object->degatTraitMod                 = $an_array['degatTraitMod'];
        $object->armorEnergyTraitMod           = $an_array['armorEnergyTraitMod'];
        $object->armorKineticTraitMod          = $an_array['armorKineticTraitMod'];
        $object->armorPenetrationBackgroundMod = $an_array['armorPenetrationBackgroundMod'];
        $object->degatBackgroundMod            = $an_array['degatBackgroundMod'];
        $object->armorEnergyBackgroundMod      = $an_array['armorEnergyBackgroundMod'];
        $object->armorKineticBackgroundMod     = $an_array['armorKineticBackgroundMod'];
        $object->armorPenetrationFactionMod    = $an_array['armorPenetrationFactionMod'];
        $object->degatFactionMod               = $an_array['degatFactionMod'];
        $object->armorEnergyFactionMod         = $an_array['armorEnergyFactionMod'];
        $object->armorKineticFactionMod        = $an_array['armorKineticFactionMod'];
        $object->armorPenetrationSoftgearMod   = $an_array['armorPenetrationSoftgearMod'];
        $object->degatSoftgearMod              = $an_array['degatSoftgearMod'];
        $object->armorEnergySoftgearMod        = $an_array['armorEnergySoftgearMod'];
        $object->armorKineticSoftgearMod       = $an_array['armorKineticSoftgearMod'];
        $object->armorPenetrationPsyMod        = $an_array['armorPenetrationPsyMod'];
        $object->degatPsyMod                   = $an_array['degatPsyMod'];
        $object->armorEnergyPsyMod             = $an_array['armorEnergyPsyMod'];
        $object->armorKineticPsyMod            = $an_array['armorKineticPsyMod'];
        $object->unique                        = (bool)$an_array['unique'];
        foreach ($an_array['bmSavePacks'] as $m) {
            array_push($object->bonusMalus, EPBonusMalus::__set_state($m));
        }

        //This is for backwards compatibility with older saves that may not have all the data
        $object->occurrence = $an_array['occurrence'] ?? $an_array['occurence'] ?? 1;

        return $object;
    }

    /**
     * EPGear constructor.
     * @param string         $name
     * @param string         $description
     * @param string         $gearType
     * @param int            $cost
     * @param int            $armorKinetic
     * @param int            $armorEnergy
     * @param string         $degat
     * @param int            $armorPenetration
     * @param EPBonusMalus[] $bonusmalus
     * @param string         $gearRestriction
     * @param bool           $isUnique
     */
    function __construct(
        string $name,
        string $description,
        string $gearType,
        int $cost,
        int $armorKinetic = 0,
        int $armorEnergy = 0,
        string $degat = '0',
        int $armorPenetration = 0,
        array $bonusmalus = array(),
        string $gearRestriction = 'EVERY',
        bool $isUnique = true
    ) {
        parent::__construct($name, $description);
        $this->gearType = $gearType;
        $this->armorKinetic = $armorKinetic;
        $this->armorEnergy = $armorEnergy;
        $this->degat = $degat;
        $this->armorPenetration = $armorPenetration;
        $this->cost = $cost;
        $this->bonusMalus = $bonusmalus;
        $this->gearRestriction = $gearRestriction;
        $this->unique = $isUnique;
        $this->armorPenetrationMorphMod = 0;
        $this->degatMorphMod = 0;
        $this->armorEnergyMorphMod = 0;
        $this->armorKineticMorphMod = 0;
        $this->armorPenetrationTraitMod = 0;
        $this->degatTraitMod = 0;
        $this->armorEnergyTraitMod = 0;
        $this->armorKineticTraitMod = 0;
        $this->armorPenetrationBackgroundMod = 0;
        $this->degatBackgroundMod = 0;
        $this->armorEnergyBackgroundMod = 0;
        $this->armorKineticBackgroundMod = 0;
        $this->armorPenetrationFactionMod = 0;
        $this->degatFactionMod = 0;
        $this->armorEnergyFactionMod = 0;
        $this->armorKineticFactionMod = 0;
        $this->armorPenetrationSoftgearMod = 0;
        $this->degatSoftgearMod = 0;
        $this->armorEnergySoftgearMod = 0;
        $this->armorKineticSoftgearMod = 0;  
        $this->armorPenetrationPsyMod = 0;
        $this->degatPsyMod = 0;
        $this->armorEnergyPsyMod = 0;
        $this->armorKineticPsyMod = 0;
    }

    /**
     * If the player can purchase more than one copy of the gear
     * @return bool
     */
    public function isUnique()
    {
        return $this->unique;
    }

    /**
     * @return int
     */
    public function getOccurrence(): int
    {
        return $this->occurrence;
    }

    /**
     * @param int $occurrence
     */
    public function setOccurrence(int $occurrence): void
    {
        $this->occurrence = $occurrence;
    }

    /**
     * If the gear is something implanted in a morph
     *
     * That means it's been surgically added in the case of biomorphs/podmorphs, or bolted on in the case of synthmorphs.
     * It can't be easily added or removed without a specialist.
     * @return bool
     */
    public function isImplant(): bool
    {
        return $this->gearType === EPGear::$IMPLANT_GEAR;
    }

    function getArmorEnergy(){
        return $this->armorEnergy + $this->armorEnergyMorphMod + $this->armorEnergyTraitMod + $this->armorEnergyBackgroundMod + $this->armorEnergyFactionMod + $this->armorEnergySoftgearMod + $this->armorEnergyPsyMod; 
    }
    function getArmorKinetic(){
        return $this->armorKinetic + $this->armorKineticMorphMod + $this->armorKineticTraitMod + $this->armorKineticBackgroundMod + $this->armorKineticFactionMod + $this->armorKineticSoftgearMod + $this->armorKineticPsyMod; 
    }
    function getDegat(){
        return $this->degat + $this->degatMorphMod + $this->degatTraitMod + $this->degatBackgroundMod + $this->degatFactionMod + $this->degatSoftgearMod + $this->degatPsyMod; 
    }
    function getArmorPenetration(){
        return $this->armorPenetration + $this->armorPenetrationMorphMod + $this->armorPenetrationTraitMod + $this->armorPenetrationBackgroundMod + $this->armorPenetrationFactionMod + $this->armorPenetrationSoftgearMod + $this->armorPenetrationPsyMod; 
    }

    /**
     * Match identical gear, even if atom Uids differ
     *
     * Gear is unique by name, gearType, and gearRestriction.
     * This is more expensive than EPAtom's version, but catches duplicate gear with different Uids.
     * @param EPGear $gear
     * @return bool
     */
    public function match($gear): bool{
        if (strcasecmp($gear->getName(),$this->getName()) == 0 &&
            $gear->gearType===$this->gearType &&
            $gear->gearRestriction===$this->gearRestriction){
                return true;
        }
        return false;
    }
}
