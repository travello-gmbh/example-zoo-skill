<?php
/**
 * PHP skeleton application for Amazon Alexa Skills
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link       https://github.com/travello-gmbh/amazon-alexa-skill-skeleton
 * @link       https://www.travello.de/
 */

namespace Zoo\Action;

use Exception;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use TravelloAlexaLibrary\Request\AlexaRequest;
use TravelloAlexaLibrary\Request\Certificate\CertificateValidator;
use TravelloAlexaLibrary\Request\Exception\BadRequest;
use Zoo\Application\ZooApplication;
use Zend\Diactoros\Response\JsonResponse;

/**
 * Class ZooAction
 *
 * @package Zoo\Action
 */
class ZooAction implements ServerMiddlewareInterface
{
    /** @var ZooApplication */
    private $zooApplication;

    /**
     * ZooAction constructor.
     *
     * @param ZooApplication $zooApplication
     */
    public function __construct(ZooApplication $zooApplication)
    {
        $this->zooApplication = $zooApplication;
    }

    /**
     * @param ServerRequestInterface $request
     * @param DelegateInterface      $delegate
     *
     * @return mixed
     */
    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        $this->zooApplication->setAlexaRequest($request->getAttribute(AlexaRequest::NAME));

        $this->zooApplication->setCertificateValidator($request->getAttribute(CertificateValidator::NAME));

        try {
            $data = $this->zooApplication->execute();

            return new JsonResponse($data, 200);
        } catch (BadRequest $e) {
            $data = ['error' => $e->getMessage()];

            return new JsonResponse($data, 400);
        } catch (Exception $e) {
            $data = ['error' => 'unknown error'];

            return new JsonResponse($data, 400);
        }
    }
}
