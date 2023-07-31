@extends ('admin.client.client_app')
@section('page_title')
  {{ __('COMPLETED AUDITS') }}
@endsection
@section('content')
  <section class="section dashboard">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-table">
            <table class="table fixed_header manage-assessments-table" id="datatable">
              <thead>
                <tr style = "text-transform:uppercase !important;">
                  <!-- <th scope="col">{{ __('USER TYPE') }}</th> -->
                  <th style="vertical-align: middle;" scope="col">{{ __('Audit Form Name') }}</th>
                  <th style="vertical-align: middle;" scope="col">{{ __('Group Name') }}</th>
                  <th style="vertical-align: middle;" scope="col">{{ __('Asset Number') }}</th>
                  <th style="vertical-align: middle;" scope="col">{{ __('Asset Name') }}</th>
                  @if(Auth::user()->role == 2)
                  <!-- <th scope="col" class="fs-12">{{ __('Total Organization Users of this subform') }}</th>
                  <th scope="col" class="fs-12">{{ __('Completed Forms (By Organization Users)') }}</th>
                  <th scope="col" class="fs-12">{{ __('Total External Users of this subform') }}</th>
                  <th scope="col" class="fs-12">{{ __('Completed Forms (By External Users)') }}</th>
                  <th scope="col">{{ __('Completed') }}</th> -->
                  @endif
                  <th style="vertical-align: middle;" scope="col">{{ __('Completed On') }}</th>
                  <th style="vertical-align: middle;" scope="col">{{ __('USER EMAIL') }}</th>
                  <th style="vertical-align: middle;" scope="col">{{ __('OPEN AUDIT') }}</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($completed_forms as $form_info)
                <tr>
                  
                  
                  <!-- <td>
                    {!! __($form_info->user_type) !!}
                  </td> -->
                  <td> 
                      @if(session('locale') == 'fr' && $form_info->subform_title_fr != null)
                      <?php echo $form_info->subform_title_fr; ?>
                      @else
                      <?php echo $form_info->subform_title; ?>
                      @endif

                  </td>
                  <td>
                    @if(session('locale') == 'fr' && $form_info->form_title_fr != null)
                    <?php echo $form_info->group_name_fr; ?>
                    @else
                    <?php echo $form_info->group_name; ?>
                    @endif
                  </td>
                  <td>
                      @if(empty($form_info->other_number))
                        A-{{ $form_info->client_id }}-{{ $form_info->asset_number }}
                      @else
                        N-{{ $form_info->client_id }}-{{ $form_info->other_number }}
                      @endif
                  </td>
                  <td>
                      @if(empty($form_info->other_number))
                          {{ $form_info->asset_name }} 
                      @else
                          {{ $form_info->other_id }} 
                      @endif
                  </td>
                  <!--  -->
                  <!-- @if(Auth::user()->role == 2)
                    <td>
                        <?php 
                            if (isset($form_info->total_internal_users_count ))
                            {
                                
                                if($form_info->total_internal_users_count > 0 )
                                {
                                  echo $form_info->total_internal_users_count;
                                }
                                else {
                                  echo '-';    
                                }
                            }
                            else
                                echo '-';            
                        ?>
                    </td>
                    <td>
                        <?php
                            if (isset($form_info->in_completed_forms ))
                            {
                              if($form_info->in_completed_forms > 0)
                              {
                                echo $form_info->in_completed_forms;
                              }
                              else{
                                echo '-';   
                              }
                              
                            }
                            else
                            echo '-';  
                                        
                        ?>            
                    </td>
                    
                    <td>
                    
                        <?php
                            if (isset($form_info->total_external_users_count ))
                            {
                              if($form_info->total_external_users_count > 0 )
                              {
                                echo $form_info->total_external_users_count;
                              }
                              else {
                                echo '-';  
                              }
                              
                            }
                            else
                                echo '-';            
                        ?>
                    </td>
                    <td>
                        <?php
                            if (isset($form_info->ex_completed_forms))
                            {
                              if($form_info->ex_completed_forms > 0)
                              {
                                echo $form_info->ex_completed_forms;
                              }
                              else{
                                echo '-'; 
                              }
                                
                            }
                            else
                                echo '-';            
                        ?>  
                    </td>
                    <td>
                        <?php
                            echo $form_info->is_locked;
                        ?>
                    </td>
                  @endif -->
                  <td>
                      <?php
                          echo date('Y-m-d', strtotime($form_info->updated));
                      ?>
                  </td> 
                  <td>
                    <?php echo $form_info->email;  ?>
                  </td>
                  <td>
                    @php
                        $form_link = ''; 
                        if ($form_info->user_type == 'Internal')
                            $form_link = url('/audit/internal/'.$form_info->form_link);
                        if ($form_info->user_type == 'External')
                            $form_link = url('/audit/external/'.$form_info->form_link);   
                    @endphp
                    <a class="btn btn-primary td_round_btn" href="<?php echo $form_link; ?>" target="_blank">{{ __('Open') }}</a>
                  </td>       
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script>
      $(document).ready(function() {
          $('#datatable').DataTable({
            "order": [],
            "language": {
              "search": "",
              "searchPlaceholder": "Search Here"
            }
          });
          
      });
  </script>
@endsection