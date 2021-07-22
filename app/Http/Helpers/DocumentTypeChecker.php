<?php
namespace App\Http\Helpers;

class DocumentTypeChecker {

    const PF_DOCUMENT_TYPE = 1;
    const PF_DOCUMENT_LENGTH = 11;
    const PJ_DOCUMENT_TYPE = 0;

    public function getDocumentType($document) {
        $strippedDocument = $this->removeSpecialCharacters($document);
        return strlen($strippedDocument) > self::PF_DOCUMENT_LENGTH ? self::PJ_DOCUMENT_TYPE : self::PF_DOCUMENT_TYPE;
    }

    public function removeSpecialCharacters($document){
        return preg_replace('/[^0-9]/', '', $document);
    }
}
