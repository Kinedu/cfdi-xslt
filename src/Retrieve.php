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
    public function changeNodeReference(string $directory) : bools
    {
        $file = $directory.$this->getFileName(static::SAT_ENDPOINT);

        $xml = file_get_contents($file);

        return true;
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
