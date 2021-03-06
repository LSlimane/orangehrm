<?php

/**
 * OrangeHRM is a comprehensive Human Resource Management (HRM) System that captures
 * all the essential functionalities required for any enterprise.
 * Copyright (C) 2006 OrangeHRM Inc., http://www.orangehrm.com
 *
 * OrangeHRM is free software; you can redistribute it and/or modify it under the terms of
 * the GNU General Public License as published by the Free Software Foundation; either
 * version 2 of the License, or (at your option) any later version.
 *
 * OrangeHRM is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
 * without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with this program;
 * if not, write to the Free Software Foundation, Inc., 51 Franklin Street, Fifth Floor,
 * Boston, MA  02110-1301, USA
 */


use Orangehrm\Rest\Http\Request;
use Orangehrm\Rest\Api\User\Attendance\EmployeePunchInAPI;
use Orangehrm\Rest\Api\Exception\NotImplementedException;

class EmployeePunchInApiAction extends BaseUserApiAction
{
    private $punchInApi = null;

    /**
     * @return EmployeePunchInAPI
     */
    public function getPunchInApi(Request $request)
    {
        if (is_null($this->punchInApi)) {
            $this->punchInApi = new EmployeePunchInAPI($request);
        }
        return $this->punchInApi;
    }

    /**
     * @param $punchInApi
     */
    public function setPunchInApi(EmployeePunchInAPI $punchInApi)
    {
        $this->punchInApi = $punchInApi;
    }

    /**
     * @param Request $request
     */
    protected function init(Request $request)
    {
        $this->punchInApi = new EmployeePunchInAPI($request);
        $this->punchInApi->setRequest($request);
        $this->postValidationRule = $this->punchInApi->getValidationRules();
    }

    /**
     * @param Request $request
     * @return \Orangehrm\Rest\Http\Response|void
     * @throws NotImplementedException
     */
    protected function handleGetRequest(Request $request)
    {
        throw new NotImplementedException();
    }

    /**
     * @OA\Post(
     *     path="/attendance/punch-in",
     *     summary="Save Employee Punch In",
     *     tags={"Attendance","User"},
     *     @OA\RequestBody(
     *         @OA\JsonContent(ref="#/components/schemas/EmployeePunchInRequestBody")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/EmployeePunchIn"),
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="No Bound User",
     *         @OA\JsonContent(ref="#/components/schemas/NoBoundUserError"),
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="No Records Found",
     *         @OA\JsonContent(ref="#/components/schemas/RecordNotFoundException"),
     *     ),
     * )
     * @OA\Schema(
     *     schema="EmployeePunchInRequestBody",
     *     type="object",
     *     @OA\Property(
     *         property="timezoneOffset",
     *         description="Time Zone Offset (ex: 5.5)",
     *         type="string"
     *     ),
     *     @OA\Property(
     *         property="datetime",
     *         description="Date and Time Required If Current Time Editable (ex: '2020-12-28 08:30')",
     *         type="string"
     *     ),
     *     @OA\Property(
     *         property="note",
     *         description="Punch In Note",
     *         type="string"
     *     ),
     * )
     * @OA\Schema(
     *     schema="EmployeePunchIn",
     *     type="object",
     *     example={"data": {"id": "1","datetime": "2020-12-28 08:30","timezoneOffset": 5.5,"note": "PUNCH IN NOTE"},"rels": {}}
     * )
     */
    protected function handlePostRequest(Request $request)
    {
        $this->setUserToContext();
        return $this->getPunchInApi($request)->savePunchIn();
    }
}
