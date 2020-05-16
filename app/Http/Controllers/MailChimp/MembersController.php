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

    /**
     * @param string $listId
     * @param string $subscriptionHash
     * @return JsonResponse
     */
    public function show(string $listId, string $subscriptionHash): JsonResponse
    {
        try {
            if (empty($listId)) {
                throw new \Exception('Empty list_id parameter');
            }
            if (empty($subscriptionHash)) {
                throw new \Exception('Empty subscription hash parameter');
            }
            $member = $this->memberService->show($listId, $subscriptionHash);
        } catch (\Exception $e) {
            return $this->errorResponse(['message' => $e->getMessage()]);
        }
        return $this->successfulResponse($member);
    }

    /**
     * @param Request $request
     * @param string $listId
     * @param string $subscriptionHash
     * @return JsonResponse
     */
    public function update(Request $request, string $listId, string $subscriptionHash): JsonResponse
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
            $member = $this->memberService->update($request->all(), $listId, $subscriptionHash);
        } catch (\Exception $e) {
            return $this->errorResponse(['message' => $e->getMessage()]);
        }
        return $this->successfulResponse($member);
    }

    /**
     * @param string $listId
     * @param string $subscriptionHash
     * @return JsonResponse
     */
    public function delete(string $listId, string $subscriptionHash): JsonResponse
    {
        try {
            $this->memberService->delete($listId, $subscriptionHash);
        } catch (\Exception $e) {
            $this->errorResponse(['message' => $e->getMessage()]);
        }
        return $this->successfulResponse(['message' => 'success']);
    }
}