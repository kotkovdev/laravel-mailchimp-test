<?php
declare(strict_types=1);
namespace App\Http\Controllers\MailChimp;

use App\Database\Entities\MailChimp\MailChimpMember;
use App\Http\Controllers\Controller;
use App\Services\MailChimp\MemberService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Mailchimp\Mailchimp;

/**
 * Class MembersController
 * @package App\Http\Controllers\MailChimp
 */
class MembersController extends Controller
{
    private $mailchimp;

    private $memberService;

    /**
     * MembersController constructor.
     * @param Mailchimp $mailchimp
     * @param MemberService $memberService
     */
    public function __construct(Mailchimp $mailchimp, MemberService $memberService)
    {
        $this->mailchimp = $mailchimp;
        $this->memberService = $memberService;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request, string $listId): JsonResponse
    {
        $validator = $this->getValidationFactory()
            ->make($request->all(), MailChimpMember::getValidationRules());

        if ($validator->fails()) {
            return $this->errorResponse([
                'message' => 'Invalid data',
                'errors' => $validator->errors()->toArray()
            ]);
        }

        try {
            if (empty($listId)) {
                throw new \Exception('Invalid list identifier in query param');
            }
            $result = $this->memberService->create($listId, $request->all());
            return $this->successfulResponse($result);
        } catch (\Exception $e) {
            return $this->errorResponse(['message' => $e->getMessage()]);
        }
    }
}