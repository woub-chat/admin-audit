<?php

namespace Admin\Extend\AdminAudit;

use Admin\Page;
use App\Admin\Controllers\Controller;
use App\Admin\Delegates\Card;
use App\Admin\Delegates\Form;
use App\Admin\Delegates\SearchForm;
use App\Admin\Delegates\ModelTable;
use App\Admin\Delegates\ModelInfoTable;
use OwenIt\Auditing\Models\Audit;
use Bfg\Attributes\Attributes;

class AuditController extends Controller
{
    /**
     * Static variable Model
     * @var string
     */
    static $model = Audit::class;

    public function defaultTools($type)
    {
        return !($type === 'edit' || $type === 'add' || $type === 'delete');
    }

    /**
     * @param Page $page
     * @param Card $card
     * @param SearchForm $searchForm
     * @param ModelTable $modelTable
     * @return Page
     */
    public function index(Page $page, Card $card, SearchForm $searchForm, ModelTable $modelTable) : Page
    {
        $models = Attributes::new()
            ->wherePath(app_path('Models'))
            ->classes()
            ->mapWithKeys(fn (\ReflectionClass $class) => [$class->getName() => $class->getName()])
            ->toArray();

        return $page->card(
            $card->search_form(
                $searchForm->id(),
                $searchForm->select('user_type', 'User type')
                    ->options($models),
                $searchForm->input('user_id', 'User ID', '='),
                $searchForm->in_select_event()->options([
                    'created' => 'created',
                    'updated' => 'updated',
                    'deleted' => 'deleted',
                ]),
                $searchForm->select('auditable_type', 'Auditable type')
                    ->options($models),
                $searchForm->input('auditable_id', 'Auditable ID', '='),
                $searchForm->input('url', 'Url'),
                $searchForm->input('ip_address', 'IP'),
                $searchForm->input('user_agent', 'User agent'),
                $searchForm->at(),
            ),
            $card->model_table(
                $modelTable->id()->to_export(),
                $modelTable->col('Url', 'url')->sort()->to_export(),
                $modelTable->col('Event', 'event')->sort()->to_export(),
                $modelTable->col('Auditable', 'auditable_type')->sort()->to_export(),
                $modelTable->col('Auditable ID', 'auditable_id')->sort()->to_export(),
                $modelTable->col('User ID', 'user_id')->sort()->true_data->to_export(),
                $modelTable->col('IP', 'ip_address')->sort()->copied()->to_export(),
                $modelTable->col('Old value', 'old_values')->only_export(),
                $modelTable->col('New value', 'new_values')->only_export(),
                $modelTable->at(),
                $modelTable->controlEdit(false),
                $modelTable->controlDelete(false),
            ),
        );
    }

    /**
     * @param Page $page
     * @param Card $card
     * @param Form $form
     * @return Page
     */
    public function matrix(Page $page, Card $card, Form $form) : Page
    {
        return $page->card(
            $card->form(
                $form->ifEdit()->info_id(),
                $form->ifEdit()->info_updated_at(),
                $form->ifEdit()->info_created_at(),
            ),
            $card->footer_form(),
        );
    }

    /**
     * @param Page $page
     * @param Card $card
     * @param ModelInfoTable $modelInfoTable
     * @return Page
     */
    public function show(Page $page, Card $card, ModelInfoTable $modelInfoTable) : Page
    {
        return $page->card(
            $card->model_info_table(
                $modelInfoTable->id(),
                $modelInfoTable->row('User type', 'user_type'),
                $modelInfoTable->row('User ID', 'user_id'),
                $modelInfoTable->row('Event', 'event'),
                $modelInfoTable->row('Auditable type', 'auditable_type'),
                $modelInfoTable->row('Auditable ID', 'auditable_id'),
                $modelInfoTable->row('Old values', 'old_values')->to_json,
                $modelInfoTable->row('New values', 'new_values')->to_json,
                $modelInfoTable->row('Url', 'url'),
                $modelInfoTable->row('IP', 'ip_address'),
                $modelInfoTable->row('User agent', 'user_agent'),
                $modelInfoTable->at(),
            ),
        );
    }

}
