<?php
namespace CodeandoMexico\Sismomx\Core\Builders;

use CodeandoMexico\Sismomx\Core\Abstracts\Builders\BuilderAbstract;
use CodeandoMexico\Sismomx\Core\Dictionaries\GoogleSheetsApiV4\CollectionCenterDictionary;
use CodeandoMexico\Sismomx\Core\Dictionaries\GoogleSheetsApiV4\HelpRequestDictionary;
use CodeandoMexico\Sismomx\Core\Dtos\HelpRequestDto;
use CodeandoMexico\Sismomx\Core\Interfaces\Builders\HelpRequestBuilderInterface;
use CodeandoMexico\Sismomx\Core\Traits\Base\DatesHelper;

/**
 * Class HelpRequestBuilder
 * @package CodeandoMexico\Sismomx\Core\Builders
 * @Injectable(scope="prototype")
 */
class HelpRequestBuilder extends BuilderAbstract implements HelpRequestBuilderInterface
{
    use DatesHelper;
    /**
     * @var HelpRequestDto
     */
    protected $builtable;

    /**
     * HelpRequestBuilder constructor.
     * @Inject
     * @param HelpRequestDto $dto
     */
    public function __construct(HelpRequestDto $dto)
    {
        $this->builtable = $dto;
    }

    /**
     * @inheritdoc
     */
    public function internalBuild()
    {
        $this->builtable->id = $this->values->getValue(HelpRequestDictionary::ID);
        $this->builtable->zone = $this->values->getValue(HelpRequestDictionary::ZONE);
        $this->builtable->urgencyLevel = $this->values->getValue(HelpRequestDictionary::URGENCY_LEVEL);
        $this->builtable->address = $this->values->getValue(HelpRequestDictionary::ADDRESS);
        $this->builtable->encodedKey = $this->values->getValue(HelpRequestDictionary::ENCODED_KEY);
        $this->builtable->admitted = $this->values->getValue(HelpRequestDictionary::ADMITTED);
        $this->builtable->brigadeRequired = $this->values->getValue(HelpRequestDictionary::BRIGADE_REQUIRED);
        $this->builtable->mostImportantRequired = $this->values->getValue(HelpRequestDictionary::MOST_IMPORTANT_REQUIRED);
        $this->builtable->notRequired = $this->values->getValue(HelpRequestDictionary::NOT_REQUIRED);
        $this->builtable->source = $this->values->getValue(HelpRequestDictionary::SOURCE);
        $this->builtable->updatedAt = $this->stringToDate(
            $this->values->getValue(HelpRequestDictionary::UPDATED_AT),
            'Y/d/m H:i'
        );
        $this->builtable->createdAt = $this->stringToDate(
            $this->values->getValue(HelpRequestDictionary::CREATED_AT),
            'Y-m-d H:i:s',
            'now'
        );
        $this->builtable->encodedKey = hash('sha256',json_encode($this->values->getValues()));
        return $this;
    }
}
