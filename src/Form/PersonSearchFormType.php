<?php

namespace App\Form;

/*
 * This file is part of the ABGEO/StalinList project.
 *
 * (c) Temuri Takalandze <me@abgeo.dev>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use App\Entity\Clause;
use App\Entity\ConvictOrganization;
use App\Entity\CourtRepresentative;
use App\Entity\DataList;
use App\Entity\Education;
use App\Entity\EducationAdditional;
use App\Entity\MaritalStatus;
use App\Entity\Nationality;
use App\Entity\SocialStatus;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\ChoiceList\View\ChoiceView;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class PersonSearchFormType.
 *
 * @category Form
 * @package  App
 */
class PersonSearchFormType extends AbstractType
{
    /**
     * @var \Symfony\Component\HttpFoundation\Request|null
     */
    private $request;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * PersonSearchFormType constructor.
     * @param RequestStack $requestStack Request stack.
     * @param EntityManagerInterface $em Entity manager.
     */
    public function __construct(RequestStack $requestStack, EntityManagerInterface $em)
    {
        $this->request = $requestStack->getCurrentRequest();
        $this->entityManager = $em;
    }

    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $requestData = $this->request->get('person_search_form');
        $requestEducation = null;
        $requestEducationAddition = null;
        $requestList = null;
        $requestSocialStatus = null;
        $requestNationality = null;
        $requestMaritalStatus = null;
        $requestConvict = null;
        $requestPresenter = null;
        $requestClauses = null;
        $requestSessionParticipants = [];

        if (isset($requestData['education'])) {
            $requestEducation = $this->entityManager->find(Education::class, $requestData['education']);
        }

        if (isset($requestData['education_additional'])) {
            $requestEducationAddition = $this->entityManager->find(
                EducationAdditional::class,
                $requestData['education_additional']
            );
        }

        if (isset($requestData['list'])) {
            $requestList = $this->entityManager->find(DataList::class, $requestData['list']);
        }

        if (isset($requestData['social_status'])) {
            $requestSocialStatus = $this->entityManager->find(SocialStatus::class, $requestData['social_status']);
        }

        if (isset($requestData['nationality'])) {
            $requestNationality = $this->entityManager->find(Nationality::class, $requestData['nationality']);
        }

        if (isset($requestData['marital_status'])) {
            $requestMaritalStatus = $this->entityManager->find(MaritalStatus::class, $requestData['marital_status']);
        }

        if (isset($requestData['convict'])) {
            $requestConvict = $this->entityManager->find(ConvictOrganization::class, $requestData['convict']);
        }

        if (isset($requestData['presenter'])) {
            $requestPresenter = $this->entityManager->find(CourtRepresentative::class, $requestData['presenter']);
        }

        if (isset($requestData['clauses'])) {
            $requestClauses = $this->entityManager->find(Clause::class, $requestData['clauses']);
        }

        foreach ($requestData['session_participants'] ?? [] as $participant) {
            $requestSessionParticipants[] = $this->entityManager->find(CourtRepresentative::class, $participant);
        }

        $builder
            ->add(
                'name',
                TextType::class,
                [
                    'label' => 'სახელი',
                    'label_attr' => ['class' => 'bmd-label-floating'],
                    'help' => 'საძიებელი რეპრესირებულის სახელი',
                    'attr' => ['class' => 'form-control'],
                    'required' => false,
                    'data' => $requestData['name'] ?? '',
                ]
            )
            ->add(
                'surname',
                TextType::class,
                [
                    'label' => 'გვარი',
                    'label_attr' => ['class' => 'bmd-label-floating'],
                    'help' => 'საძიებელი რეპრესირებულის გვარი',
                    'attr' => ['class' => 'form-control'],
                    'required' => false,
                    'data' => $requestData['surname'] ?? '',
                ]
            )
            ->add(
                'patronymic',
                TextType::class,
                [
                    'label' => 'მამის სახელი',
                    'label_attr' => ['class' => 'bmd-label-floating'],
                    'help' => 'საძიებელი რეპრესირებულის მამის სახელი',
                    'attr' => ['class' => 'form-control'],
                    'required' => false,
                    'data' => $requestData['patronymic'] ?? '',
                ]
            )
            ->add(
                'birth_date',
                TextType::class,
                [
                    'label' => 'დაბადების თარიღი',
                    'label_attr' => ['class' => 'bmd-label-floating'],
                    'help' => 'საძიებელი რეპრესირებულის დაბადების თარიღი',
                    'attr' => ['class' => 'form-control'],
                    'required' => false,
                    'data' => $requestData['birth_date'] ?? '',
                ]
            )
            ->add(
                'place_of_birth',
                TextType::class,
                [
                    'label' => 'დაბადების ადგილი',
                    'label_attr' => ['class' => 'bmd-label-floating'],
                    'help' => 'საძიებელი რეპრესირებულის დაბადების ადგილი',
                    'attr' => ['class' => 'form-control'],
                    'required' => false,
                    'data' => $requestData['place_of_birth'] ?? '',
                ]
            )
            ->add(
                'dwelling_place',
                TextType::class,
                [
                    'label' => 'საცხოვრებელი ადგილი',
                    'label_attr' => ['class' => 'bmd-label-floating'],
                    'help' => 'საძიებელი რეპრესირებულის საცხოვრებელი ადგილი',
                    'attr' => ['class' => 'form-control'],
                    'required' => false,
                    'data' => $requestData['dwelling_place'] ?? '',
                ]
            )
            ->add(
                'partying',
                TextType::class,
                [
                    'label' => 'პარტიულობა',
                    'label_attr' => ['class' => 'bmd-label-floating'],
                    'help' => 'საძიებელი რეპრესირებულის პარტიულობა',
                    'attr' => ['class' => 'form-control'],
                    'required' => false,
                    'data' => $requestData['partying'] ?? '',
                ]
            )
            ->add(
                'working_position',
                TextType::class,
                [
                    'label' => 'სამუშაო ადგილი',
                    'label_attr' => ['class' => 'bmd-label-floating'],
                    'help' => 'საძიებელი რეპრესირებულის სამუშაო ადგილი',
                    'attr' => ['class' => 'form-control'],
                    'required' => false,
                    'data' => $requestData['working_position'] ?? '',
                ]
            )
            ->add(
                'conviction',
                TextType::class,
                [
                    'label' => 'ნასამართლეობა წარსულში',
                    'label_attr' => ['class' => 'bmd-label-floating'],
                    'help' => 'საძიებელი რეპრესირებულის ნასამართლეობა წარსულში',
                    'attr' => ['class' => 'form-control'],
                    'required' => false,
                    'data' => $requestData['conviction'] ?? '',
                ]
            )
            ->add(
                'date_of_arrest',
                TextType::class,
                [
                    'label' => 'დაპატიმრების თარიღი',
                    'label_attr' => ['class' => 'bmd-label-floating'],
                    'help' => 'საძიებელი რეპრესირებულის დაპატიმრების თარიღი',
                    'attr' => ['class' => 'form-control datetimepicker'],
                    'required' => false,
                    'data' => $requestData['date_of_arrest'] ?? '',
                ]
            )
            ->add(
                'investigator',
                TextType::class,
                [
                    'label' => 'ვინ იძიებდა საქმეს',
                    'label_attr' => ['class' => 'bmd-label-floating'],
                    'help' => 'რომელი ორგანო იძიებდა საძიებელი რეპრესირებულის საქმეს',
                    'attr' => ['class' => 'form-control'],
                    'required' => false,
                    'data' => $requestData['investigator'] ?? '',
                ]
            )
            ->add(
                'session_date',
                TextType::class,
                [
                    'label' => 'სხდომის თარიღი',
                    'label_attr' => ['class' => 'bmd-label-floating'],
                    'help' => 'საძიებელი რეპრესირებულის სხდომის თარიღი',
                    'attr' => ['class' => 'form-control datetimepicker'],
                    'required' => false,
                    'data' => $requestData['session_date'] ?? '',
                ]
            )
            ->add(
                'education',
                EntityType::class,
                [
                    'class' => Education::class,
                    'label' => 'განათლება',
                    'attr' => ['class' => 'form-control selectpicker', 'data-style' => 'btn btn-link'],
                    'required' => false,
                    'data' => $requestEducation,
                ]
            )
            ->add(
                'education_additional',
                EntityType::class,
                [
                    'class' => EducationAdditional::class,
                    'label' => 'განათლება დეტალურად',
                    'attr' => ['class' => 'form-control selectpicker', 'data-style' => 'btn btn-link'],
                    'required' => false,
                    'data' => $requestEducationAddition,
                ]
            )
            ->add(
                'blame',
                TextType::class,
                [
                    'label' => 'ბრალდება',
                    'label_attr' => ['class' => 'bmd-label-floating'],
                    'help' => 'საძიებელი რეპრესირებულის ბრალდება',
                    'attr' => ['class' => 'form-control'],
                    'required' => false,
                    'data' => $requestData['blame'] ?? '',
                ]
            )
            ->add(
                'verdict',
                TextType::class,
                [
                    'label' => 'განაჩენი',
                    'label_attr' => ['class' => 'bmd-label-floating'],
                    'help' => 'საძიებელი რეპრესირებულის განაჩენი',
                    'attr' => ['class' => 'form-control'],
                    'required' => false,
                    'data' => $requestData['verdict'] ?? '',
                ]
            )
            ->add(
                'verdict_date',
                TextType::class,
                [
                    'label' => 'განაჩენის თარიღი',
                    'label_attr' => ['class' => 'bmd-label-floating'],
                    'help' => 'საძიებელი რეპრესირებულის განაჩენის აღსრულების თარიღი',
                    'attr' => ['class' => 'form-control datetimepicker'],
                    'required' => false,
                    'data' => $requestData['verdict_date'] ?? '',
                ]
            )
            ->add(
                'rehabilitation',
                TextType::class,
                [
                    'label' => 'რეაბილიტაცია',
                    'label_attr' => ['class' => 'bmd-label-floating'],
                    'help' => 'საძიებელი რეპრესირებულის რეაბილიტაცია',
                    'attr' => ['class' => 'form-control'],
                    'required' => false,
                    'data' => $requestData['rehabilitation'] ?? '',
                ]
            )
            ->add(
                'notes',
                TextType::class,
                [
                    'label' => 'შენიშვნა',
                    'label_attr' => ['class' => 'bmd-label-floating'],
                    'help' => 'საძიებელი რეპრესირებულის დოსიეს შენიშვნა',
                    'attr' => ['class' => 'form-control'],
                    'required' => false,
                    'data' => $requestData['notes'] ?? '',
                ]
            )
            ->add(
                'rank_in_past',
                TextType::class,
                [
                    'label' => 'წოდება წარსულში',
                    'label_attr' => ['class' => 'bmd-label-floating'],
                    'help' => 'საძიებელი რეპრესირებულის წოდება წარსულში',
                    'attr' => ['class' => 'form-control'],
                    'required' => false,
                    'data' => $requestData['rank_in_past'] ?? '',
                ]
            )
            ->add(
                'list',
                EntityType::class,
                [
                    'class' => DataList::class,
                    'label' => 'სია',
                    'attr' => ['class' => 'form-control selectpicker', 'data-style' => 'btn btn-link'],
                    'required' => false,
                    'data' => $requestList,
                ]
            )
            ->add(
                'social_status',
                EntityType::class,
                [
                    'class' => SocialStatus::class,
                    'label' => 'სოციალური სტატუსი',
                    'attr' => ['class' => 'form-control selectpicker', 'data-style' => 'btn btn-link'],
                    'required' => false,
                    'data' => $requestSocialStatus,
                ]
            )
            ->add(
                'nationality',
                EntityType::class,
                [
                    'class' => Nationality::class,
                    'label' => 'ეროვნება',
                    'attr' => ['class' => 'form-control selectpicker', 'data-style' => 'btn btn-link'],
                    'required' => false,
                    'data' => $requestNationality,
                ]
            )
            ->add(
                'marital_status',
                EntityType::class,
                [
                    'class' => MaritalStatus::class,
                    'label' => 'ოჯახური მდგომარეობა',
                    'attr' => ['class' => 'form-control selectpicker', 'data-style' => 'btn btn-link'],
                    'required' => false,
                    'data' => $requestMaritalStatus,
                ]
            )
            ->add(
                'convict',
                EntityType::class,
                [
                    'class' => ConvictOrganization::class,
                    'label' => 'გასამართლების ორგანო',
                    'attr' => ['class' => 'form-control selectpicker', 'data-style' => 'btn btn-link'],
                    'required' => false,
                    'data' => $requestConvict,
                ]
            )
            ->add(
                'presenter',
                EntityType::class,
                [
                    'class' => CourtRepresentative::class,
                    'label' => 'სხდომის მომხსენებელი',
                    'attr' => ['class' => 'form-control selectpicker', 'data-style' => 'btn btn-link'],
                    'required' => false,
                    'data' => $requestPresenter,
                ]
            )
            ->add(
                'clauses',
                EntityType::class,
                [
                    'class' => Clause::class,
                    'label' => 'მუხლი',
                    'attr' => ['class' => 'form-control selectpicker', 'data-style' => 'btn btn-link'],
                    'required' => false,
                    'data' => $requestClauses,
                ]
            )
            ->add(
                'session_participants',
                EntityType::class,
                [
                    'class' => CourtRepresentative::class,
                    'multiple' => true,
                    'label' => 'სხდომის მონაწილეები',
                    'attr' => ['class' => 'form-control selectpicker', 'data-style' => 'btn btn-link'],
                    'required' => false,
                    'data' => $requestSessionParticipants,
                ]
            )
            ->add(
                'search',
                SubmitType::class,
                [
                    'label' => 'ძიება',
                    'attr' => [
                        'class' => 'btn btn-success btn-block btn-flat',
                    ],
                ]
            );
    }

    /**
     * {@inheritDoc}
     */
    public function finishView(FormView $view, FormInterface $form, array $options)
    {
        $sort = static function (ChoiceView $a, ChoiceView $b) {
            return strcasecmp($a->label, $b->label);
        };

        usort($view->children['education']->vars['choices'], $sort);
        usort($view->children['education_additional']->vars['choices'], $sort);
        usort($view->children['social_status']->vars['choices'], $sort);
        usort($view->children['nationality']->vars['choices'], $sort);
        usort($view->children['marital_status']->vars['choices'], $sort);
        usort($view->children['convict']->vars['choices'], $sort);
        usort($view->children['presenter']->vars['choices'], $sort);
        usort($view->children['clauses']->vars['choices'], $sort);
    }

    /**
     * {@inheritDoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                // Configure your form options here
            ]
        );
    }
}
