<?php

namespace App\Application\Boardgames\Transformer;

use App\Domain\Boardgames\Entity\Boardgame;
use App\Domain\Common\Exception\WrongDataException;
use Throwable;

class bggXMLToBoardgameTransformer extends XMLToJSONTransformer
{
    private const XML_ID_PATH='@attributes.objectid';
    private const XML_NAME='name';
    private const XML_DESCRIPTION='description';
    private const XML_ATTRIBUTES='@attributes';

 /**
  * @throws Throwable
  */
    public function transform(string $bggXml): Boardgame
    {
        $xml = simplexml_load_string($bggXml);
        $json = json_encode($xml);
        $arrData = json_decode($json,true);
        $boardgameData = $arrData['boardgame'] ?? throw new WrongDataException("data not found");

        $id = $this->getValueFromArrayPath($boardgameData, self::XML_ID_PATH)
            ?? throw new WrongDataException("id not found");

        $name = $this->getValueFromArrayPath($boardgameData, self::XML_NAME)
            ?? throw new WrongDataException("name not found");

        $description = $this->getValueFromArrayPath($boardgameData, self::XML_NAME)
            ?? throw new WrongDataException("description not found");

        return new Boardgame(
            $id,
            is_array($name) ? $name[0] : $name,
            $description,
        );
    }
}