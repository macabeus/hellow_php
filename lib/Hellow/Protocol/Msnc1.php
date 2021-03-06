<?php
/*  HellowPhp, alpha version
 *  (c) 2009 Gustavo Maia Neto (gutomaia)
 *
 *  HellowPhp and all other Hellow flavors will be always
 *  freely distributed under the terms of an GPLv3 license.
 *
 *  Human Knowledge belongs to the World!
 *--------------------------------------------------------------------------*/

namespace Hellow\Protocol;

class Msnc1 extends Switchboard
{
    public static function getDisplayPicture($nsProtocol,$contact)
    {
        $this->usr();
        $this->cal($contact);
    }
    /*
    * 0x01: This means you are running a Windows Mobile device. The official client changes the little icon to a little man with a phone, and puts the status 'Phone' next to your name.
    * 0x02: This value is set if you are a MSN Explorer 8 user, but it is sometimes used when the client resets its capabilities
    * 0x04: Your client can send/receive Ink (GIF format)
    * 0x08: Your client can send/recieve Ink (ISF format)
    * 0x10: This option is set when you are able to participate in video conversations. In reality, it is only set when you have a webcam connected and have it set to 'shared'.
    * 0x20: This value is being used with Multi-Packet Messaging.
    * 0x40: This is used when the client is running on a MSN Mobile device. This is equivalent to the MOB setting in the BPR list.
    * 0x80: This is used when the client is running on a MSN Direct device. This is equivalent to the WWE setting in the BPR list.
    * 0x200: This is used when someone signs in on the official Web-based MSN Messenger. It will show a new icon in other people's contact list.
    * 0x800: Internal Microsoft client and/or Microsoft Office Live client.
    * 0x1000: This means you have a MSN Space.
    * 0x2000: This means you are using Windows XP Media Center Edition.
    * 0x4000: This means you support 'DirectIM' (creating direct connections for conversations rather than using the traditional switchboard)
    * 0x8000: This means you support Winks receiving (If not set the official Client will warn with 'contact has an older client and is not capable of receiving Winks')
    * 0x10000: Your client supports the MSN Search feature
    * 0x40000: This means you support Voice Clips receiving
    * 0x80000: This means you support Secure Channel Communications
    * 0x100000: Supports SIP Invitations
    * 0x400000: Sharing Folders
    * 0x10000000: This is the value for MSNC1 (MSN Msgr 6.0)
    * 0x20000000: This is the value for MSNC2 (MSN Msgr 6.1)
    * 0x30000000: This is the value for MSNC3 (MSN Msgr 6.2)
    * 0x40000000: This is the value for MSNC4 (MSN Msgr 7.0)
    * 0x50000000: This is the value for MSNC5 (MSN Msgr 7.5)
    * 0x60000000: This is the value for MSNC6 (WL Msgr 8.0)
    * 0x70000000: This is the value for MSNC7 (WL Msgr 8.1)
    * 0x80000000: This is the value for MSNC8 (WL Msgr 8.5)
    * */
    //$sessionType = CHAT / DISPLAYOBJECT /

    public function execute($cmd, $params = null)
    {
        if (!empty ($cmd))
            switch ($cmd) {
                case "USR" :
                    break;
                case "CAL" :
                    break;
                case "JOI" :
                    break;
                case "MSG" :
                    if ($params[2] == "TWN") {
                        $this->_passport = $this->authenticate($this->getUsername(), $this->getPassword(), $params[4]);
                        $this->send($this->usr());
                    } elseif ($params[2] == "OK") {
                        $this->onLogged(null);
                        $this->send($this->syn());
                    }
                    break;
                case "ACK" :
                    break;
                case "BYE" :
                    break;
                case "OUT" :
                    break;
                default :
                    echo "MSG RESPONSAVEL POR ERRO---$msg---";
                    var_dump($cmd);
                    //$cont = false;
                    //die();
                    //$this->disconnect();
            }
    }

    public function usr()
    {
        if ($this->_passport == null) {
            return "USR " . $this->_trid . ' ' . $this->_username .' '.$this->_passport. $this->EL;
        }
    }

    public function cal($contact)
    {
        return 'CAL '.$this->_trid.' '.$contact.$this->EL;
    }

    public function msg()
    {
    }
/*
USR 1 hellow@hotmail.com 700432717.4772207.1043557
USR 1 OK hellow@hotmail.com guto
CAL 2 buddy@msn.com
CAL 2 RINGING 700432717
JOI buddy@msn.com buddy
MSG 3 D 798
*/

}
