<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* themes/contrib/bootstrap5/templates/admin/system-modules-details.html.twig */
class __TwigTemplate_436ccc82bfd278f30956fd2b7b2b2bfb extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->extensions[SandboxExtension::class];
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 25
        yield "<table";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["attributes"] ?? null), "addClass", ["table"], "method", false, false, true, 25), "html", null, true);
        yield ">
  <thead>
  <tr>
    <th class=\"checkbox visually-hidden\">";
        // line 28
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Installed"));
        yield "</th>
    <th class=\"name visually-hidden\">";
        // line 29
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Name"));
        yield "</th>
    <th class=\"description visually-hidden priority-low\">";
        // line 30
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Description"));
        yield "</th>
  </tr>
  </thead>
  <tbody>
  ";
        // line 34
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["modules"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["module"]) {
            // line 35
            yield "    <tr";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["module"], "attributes", [], "any", false, false, true, 35), "html", null, true);
            yield ">
      <td class=\"checkbox\">
        ";
            // line 37
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["module"], "checkbox", [], "any", false, false, true, 37), "html", null, true);
            yield "
      </td>
      <td class=\"module\">
        <label id=\"";
            // line 40
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["module"], "id", [], "any", false, false, true, 40), "html", null, true);
            yield "\" for=\"";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["module"], "enable_id", [], "any", false, false, true, 40), "html", null, true);
            yield "\" class=\"module-name table-filter-text-source\">";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["module"], "name", [], "any", false, false, true, 40), "html", null, true);
            yield "</label>
      </td>
      <td class=\"description expand priority-low\">
        <details class=\"js-form-wrapper form-wrapper text-wrap\" id=\"";
            // line 43
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["module"], "enable_id", [], "any", false, false, true, 43), "html", null, true);
            yield "-description\">
          <summary aria-controls=\"";
            // line 44
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["module"], "enable_id", [], "any", false, false, true, 44), "html", null, true);
            yield "-description\" role=\"button\" aria-expanded=\"false\"><span class=\"text module-description\">";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["module"], "description", [], "any", false, false, true, 44), "html", null, true);
            yield "</span></summary>
          <div class=\"details-wrapper\">
            <div class=\"details-description\">
              <div class=\"requirements\">
                <div class=\"admin-requirements\">";
            // line 48
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Machine name: <span dir=\"ltr\" class=\"table-filter-text-source\">@machine-name</span>", ["@machine-name" => CoreExtension::getAttribute($this->env, $this->source, $context["module"], "machine_name", [], "any", false, false, true, 48)]));
            yield "</div>
                ";
            // line 49
            if (CoreExtension::getAttribute($this->env, $this->source, $context["module"], "version", [], "any", false, false, true, 49)) {
                // line 50
                yield "                  <div class=\"admin-requirements\">";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Version: @module-version", ["@module-version" => CoreExtension::getAttribute($this->env, $this->source, $context["module"], "version", [], "any", false, false, true, 50)]));
                yield "</div>
                ";
            }
            // line 52
            yield "                ";
            if (CoreExtension::getAttribute($this->env, $this->source, $context["module"], "requires", [], "any", false, false, true, 52)) {
                // line 53
                yield "                  <div class=\"admin-requirements\">";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Requires: @module-list", ["@module-list" => CoreExtension::getAttribute($this->env, $this->source, $context["module"], "requires", [], "any", false, false, true, 53)]));
                yield "</div>
                ";
            }
            // line 55
            yield "                ";
            if (CoreExtension::getAttribute($this->env, $this->source, $context["module"], "required_by", [], "any", false, false, true, 55)) {
                // line 56
                yield "                  <div class=\"admin-requirements\">";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Required by: @module-list", ["@module-list" => CoreExtension::getAttribute($this->env, $this->source, $context["module"], "required_by", [], "any", false, false, true, 56)]));
                yield "</div>
                ";
            }
            // line 58
            yield "              </div>
              ";
            // line 59
            if (CoreExtension::getAttribute($this->env, $this->source, $context["module"], "links", [], "any", false, false, true, 59)) {
                // line 60
                yield "                <div class=\"links\">
                  ";
                // line 61
                $context['_parent'] = $context;
                $context['_seq'] = CoreExtension::ensureTraversable(["help", "permissions", "configure"]);
                foreach ($context['_seq'] as $context["_key"] => $context["link_type"]) {
                    // line 62
                    yield "                    ";
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, (($_v0 = CoreExtension::getAttribute($this->env, $this->source, $context["module"], "links", [], "any", false, false, true, 62)) && is_array($_v0) || $_v0 instanceof ArrayAccess && in_array($_v0::class, CoreExtension::ARRAY_LIKE_CLASSES, true) ? ($_v0[$context["link_type"]] ?? null) : CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["module"], "links", [], "any", false, false, true, 62), $context["link_type"], [], "array", false, false, true, 62)), "html", null, true);
                    yield "
                  ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_key'], $context['link_type'], $context['_parent']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 64
                yield "                </div>
              ";
            }
            // line 66
            yield "            </div>
          </div>
        </details>
      </td>
    </tr>
  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['module'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 72
        yield "  </tbody>
</table>
";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["attributes", "modules"]);        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "themes/contrib/bootstrap5/templates/admin/system-modules-details.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  171 => 72,  160 => 66,  156 => 64,  147 => 62,  143 => 61,  140 => 60,  138 => 59,  135 => 58,  129 => 56,  126 => 55,  120 => 53,  117 => 52,  111 => 50,  109 => 49,  105 => 48,  96 => 44,  92 => 43,  82 => 40,  76 => 37,  70 => 35,  66 => 34,  59 => 30,  55 => 29,  51 => 28,  44 => 25,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "themes/contrib/bootstrap5/templates/admin/system-modules-details.html.twig", "/app/web/themes/contrib/bootstrap5/templates/admin/system-modules-details.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = ["for" => 34, "if" => 49];
        static $filters = ["escape" => 25, "t" => 28];
        static $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['for', 'if'],
                ['escape', 't'],
                [],
                $this->source
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->source);

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }
}
