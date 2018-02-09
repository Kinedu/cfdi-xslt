<?php

/*
 * This file is part of the cfdi-xslt project.
 *
 * (c) Kinedu
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Kinedu\CfdiXslt;

use SimpleXMLElement;
use DOMDocument;
use DOMXpath;

class Retrieve
{
    /**
     * SAT Endpoint
     *
     * @var string
     */
    const SAT_ENDPOINT = 'http://www.sat.gob.mx/sitio_internet/cfd/3/cadenaoriginal_3_3/cadenaoriginal_3_3.xslt';

    /**
     * @return array
     */
    protected function getIncludeFiles() : array
    {
        $files[] = static::SAT_ENDPOINT;

        $xml = new SimpleXMLElement(
            file_get_contents(static::SAT_ENDPOINT)
        );

        foreach ($xml->xpath('//xsl:include') as $node) {
            $files[] = reset($node['href']);
        }

        return $files;
    }

    /**
     * @param string $directory
     *
     * @return bool
     */
    public function changeNodeReference(string $directory) : bool
    {
        $file = $directory.$this->getFileName(static::SAT_ENDPOINT);

        $dom = new DOMDocument();
        $dom->load($file);

        $xpath = new DOMXpath($dom);
        $query = '//xsl:include';

        foreach ($xpath->query($query) as $node) {
            $href = $node->getAttribute('href');

            $node->setAttribute(
                'href',
                $this->getFileName($href)
            );
        }

        return $dom->save($file);
    }

    /**
     * @param string $directory
     *
     * @return bool
     */
    public function download(string $directory) : bool
    {
        foreach ($this->getIncludeFiles() as $url) {
            $file = file_get_contents($url);
            $fileName = $this->getFileName($url);

            file_put_contents("{$directory}{$fileName}", $file);
        }

        $this->changeNodeReference($directory);

        return true;
    }

    /**
     * @param string $file
     *
     * @return string
     */
    protected function getFileName(string $file) : string
    {
        return basename($file);
    }
}
