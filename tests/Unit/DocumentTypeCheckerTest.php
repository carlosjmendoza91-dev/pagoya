<?php

namespace AppTests\Unit;

use TestCase;
use App\Http\Helpers\DocumentTypeChecker;

class DocumentTypeCheckerTest extends TestCase
{
    /**
     * Teste para remover caracteres especiais do cpf.
     *
     * @return void
     */
    public function testRemoveCaracteresCPF()
    {
        $documentTypeChecker = new DocumentTypeChecker();
        $cpf = '063.913.247-27';
        $this->assertEquals('06391324727', $documentTypeChecker->removeSpecialCharacters($cpf));
    }

    /**
     * Teste para remover caracteres especiais do cnpj.
     *
     * @return void
     */
    public function testRemoveCaracteresCNPJ()
    {
        $documentTypeChecker = new DocumentTypeChecker();
        $cnpj = '17.284.275/0001-05';
        $this->assertEquals('17284275000105', $documentTypeChecker->removeSpecialCharacters($cnpj));
    }

    /**
     * Teste para obter tipo de usuario a partir de cpf.
     *
     * @return void
     */
    public function testRetornaTipoDeUsuarioCPF()
    {
        $documentTypeChecker = new DocumentTypeChecker();
        $cpf = '063.913.247-27';
        $this->assertEquals($documentTypeChecker::PF_DOCUMENT_TYPE, $documentTypeChecker->getDocumentType($cpf));
    }

    /**
     * Teste para obter tipo de usuario a partir de cnpj.
     *
     * @return void
     */
    public function testRetornaTipoDeUsuarioCNPJ()
    {
        $documentTypeChecker = new DocumentTypeChecker();
        $cnpj = '17.284.275/0001-05';
        $this->assertEquals($documentTypeChecker::PJ_DOCUMENT_TYPE, $documentTypeChecker->getDocumentType($cnpj));
    }
}
