<?php

namespace App\Formatter;

class SpellDescriptionFormatter
{
    public function format(?string $description): string
    {
        if (empty($description)) {
            return '';
        }

        $doc = new \DOMDocument();
        $doc->loadHTML('<?xml encoding="utf-8" ?><div>'.$description.'</div>');
        $xpath = new \DOMXpath($doc);

        // Gestion des cas avec <div class="pf1frDescr">...</div>, on ne renvoie que le contenu de cette div
        $element = $xpath->query("//div[contains(@class, 'pf1frDescr')]")->item(0);
        if (null !== $element) {
            return $this->getDOMNodeInnerHTML($element);
        }

        // Gestion des cas avec <div class="spell-description">, on renvoie tout sauf cette div
        $element = $xpath->query("//div[contains(@class, 'spell-description')]")->item(0);
        if (null !== $element) {
            $element->parentNode->removeChild($element);

            $description = trim(substr($doc->saveXML($doc->getElementsByTagName('div')->item(0)), 5, -6));
        }

        return $description;
    }

    private function getDOMNodeInnerHTML(\DOMNode $element): string
    {
        $innerHTML = '';

        foreach ($element->childNodes as $child) {
            $innerHTML .= $element->ownerDocument->saveHTML($child);
        }

        return $innerHTML;
    }
}
